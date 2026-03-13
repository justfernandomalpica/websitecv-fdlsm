const MPK_TEXT_TAGS = new Set(["h1", "h2", "h3", "h4", "h5", "h6", "p"]);
const MPK_CONTAINER_TAGS = new Set(["ul", "ol", "li"]);
const MPK_SELF_CLOSING_TAGS = new Set(["br"]);

function tokenizeMPK(source) {
  const tokens = [];
  let i = 0;

  while (i < source.length) {
    if (source[i] !== "@") {
      i++;
      continue;
    }

    const tagToken = readMPKTagAt(source, i);

    if (!tagToken) {
      i++;
      continue;
    }

    if (tagToken.type === "OPEN" || tagToken.type === "CLOSE") {
      tokens.push({
        type: tagToken.type,
        tag: tagToken.tag,
      });

      i = tagToken.end + 1;
      continue;
    }

    if (tagToken.type === "SELF_CLOSING") {
      tokens.push({
        type: "SELF_CLOSING",
        tag: tagToken.tag,
      });

      i = tagToken.end;
      continue;
    }

    if (tagToken.type === "TEXT") {
      let contentStart = tagToken.end;

      while (contentStart < source.length && /\s/.test(source[contentStart])) {
        contentStart++;
      }

      let j = contentStart;
      let nextInstructionIndex = source.length;

      while (j < source.length) {
        if (source[j] === "@") {
          const nextTag = readMPKTagAt(source, j);

          if (nextTag) {
            nextInstructionIndex = j;
            break;
          }
        }
        j++;
      }

      const content = source.slice(contentStart, nextInstructionIndex).trim();

      tokens.push({
        type: "TEXT",
        tag: tagToken.tag,
        content,
      });

      i = nextInstructionIndex;
      continue;
    }

    i++;
  }

  return tokens;
}

function readMPKTagAt(source, startIndex) {
  if (source[startIndex] !== "@") {
    return null;
  }

  let i = startIndex + 1;
  let tag = "";

  while (i < source.length && /[a-zA-Z0-9]/.test(source[i])) {
    tag += source[i];
    i++;
  }

  if (!tag) {
    return null;
  }

  const nextChar = source[i] ?? "";

  if (nextChar === "(" && MPK_CONTAINER_TAGS.has(tag)) {
    return {
      type: "OPEN",
      tag,
      start: startIndex,
      end: i + 1,
    };
  }

  if (nextChar === ")" && MPK_CONTAINER_TAGS.has(tag)) {
    return {
      type: "CLOSE",
      tag,
      start: startIndex,
      end: i + 1,
    };
  }

  if (
    (nextChar === "" || /\s/.test(nextChar)) &&
    MPK_SELF_CLOSING_TAGS.has(tag)
  ) {
    return {
      type: "SELF_CLOSING",
      tag,
      start: startIndex,
      end: i,
    };
  }

  if ((nextChar === "" || /\s/.test(nextChar)) && MPK_TEXT_TAGS.has(tag)) {
    return {
      type: "TEXT",
      tag,
      start: startIndex,
      end: i,
    };
  }

  return null;
}

function parseMPKTokens(tokens) {
  const root = {
    type: "root",
    children: [],
  };

  const stack = [root];

  for (const token of tokens) {
    const currentNode = stack[stack.length - 1];

    if (token.type === "TEXT") {
      currentNode.children.push({
        type: token.tag,
        content: token.content,
        line: token.line,
      });
      continue;
    }

    if (token.type === "SELF_CLOSING") {
      currentNode.children.push({
        type: token.tag,
        line: token.line,
      });
      continue;
    }

    if (token.type === "OPEN") {
      const newNode = {
        type: token.tag,
        children: [],
        line: token.line,
      };

      currentNode.children.push(newNode);
      stack.push(newNode);
      continue;
    }

    if (token.type === "CLOSE") {
      if (stack.length === 1) {
        throw new Error(
          `Error MPK en línea ${token.line}: se encontró cierre "@${token.tag})" sin una apertura correspondiente.`,
        );
      }

      const lastOpenedNode = stack[stack.length - 1];

      if (lastOpenedNode.type !== token.tag) {
        throw new Error(
          `Error MPK en línea ${token.line}: se esperaba cierre de "@${lastOpenedNode.type})" pero se encontró "@${token.tag})".`,
        );
      }

      stack.pop();
      continue;
    }

    throw new Error(
      `Error MPK en línea ${token.line}: tipo de token no soportado "${token.type}".`,
    );
  }

  if (stack.length > 1) {
    const unclosedNode = stack[stack.length - 1];

    throw new Error(
      `Error MPK: la etiqueta "@${unclosedNode.type}(" abierta en la línea ${unclosedNode.line} no fue cerrada.`,
    );
  }

  return root;
}

function escapeHTML(value) {
  return String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;");
}

function compileMPKNode(node) {
  if (node.type === "root") {
    return node.children.map(compileMPKNode).join("");
  }

  if (node.type === "br") {
    return "<br>";
  }

  if (["h1", "h2", "h3", "h4", "h5", "h6", "p"].includes(node.type)) {
    return `<${node.type}>${escapeHTML(node.content)}</${node.type}>`;
  }

  if (["ul", "ol", "li"].includes(node.type)) {
    const childrenHTML = node.children.map(compileMPKNode).join("");
    return `<${node.type}>${childrenHTML}</${node.type}>`;
  }

  throw new Error(`Error MPK: nodo no soportado "${node.type}".`);
}

function renderMPKRichText() {
  const containers = document.querySelectorAll(".rich-text");

  if (!containers.length) {
    return;
  }

  containers.forEach((container) => {
    try {
      const source = container.textContent || "";
      const tokens = tokenizeMPK(source);
      const ast = parseMPKTokens(tokens);
      const html = compileMPKNode(ast);

      container.innerHTML = html;
    } catch (error) {
      console.error("Error al compilar contenido MPK:", error);
      container.innerHTML = "<p>Error al renderizar el contenido.</p>";
    }
  });
}

document.addEventListener("DOMContentLoaded", renderMPKRichText);
