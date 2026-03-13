<div class="portfolio-container">
    <h1>Portafolio</h1>
    <p>
        A lo largo de mi carrera profesional y educativa eh realizado diversos proyectos que involucran una 
        o mas areas de conocimiento en las que he podido especializarme. A continuación se muestra un compilado 
        de dichos proyectos. 
    </p>

    <div class="portfolio-articles">
        <?php use Models\Images; ?>
    <?php foreach ($projects as $project) : ?>
        <article class="article">
        <picture class="article-image">
          <source srcset="build/img/projects/<?= Images::where("projectId",$project->id)->name ?>.webp" type="image/webp" />
          <img
            loading="lazy"
            src="build/img/projects/<?= Images::where("projectId",$project->id)->name ?>.jpeg"
            alt="Chua's Circuit"
          />
        </picture>
        <div class="article-content">
            <h3><?= $project->name ?></h3>
            <p>
            <?= $project->short_description ?>
            </p>
            <a href="/project?id=<?= $project->id ?>" class="article-button">Ver&nbsp;Proyecto</a>
        </div>
        </article>
    <?php endforeach; ?>
    </div>
</div>