<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/">IEPSA Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if($controller == "articles"): ?>active<?php endif ?>">
        <a class="nav-link" href="/articles" >Articles</a>
      </li>
      <li class="nav-item <?php if($controller == "users"): ?>active<?php endif ?>">
        <a class="nav-link" href="/users">Users</a>
      </li>
    </ul>
  </div>
</nav>
<br>
<br>
<br>
<br>

