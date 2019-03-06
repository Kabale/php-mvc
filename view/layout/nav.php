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
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <button class="btn btn-outline-<?php if(!ISSET($_SESSION["authentication"]) || $_SESSION["authentication"] == null): ?>success<?php else:?>warning<?php endif?> my-2 my-sm-0" type="button" onclick="window.location.href ='/authentication/<?php if(!ISSET($_SESSION["authentication"]) || $_SESSION["authentication"] == null): ?>login<?php else:?>logout<?php endif?>';">
        <?php if(!ISSET($_SESSION["authentication"]) || $_SESSION["authentication"] == null): ?>Login<?php else:?>Logout<?php endif?></button>
      </form>
  </div>
</nav>
<br>
<br>
<br>
<br>

