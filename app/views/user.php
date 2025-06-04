<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<form action="/user/update/12" method="post">

  <input type="text" name="firstName" value="Lucas">
  <input type="text" name="lastName" value="Tenório">
  <input type="text" name="email" value="lucas@email.com">
  <input type="text" name="password" value="123">

  <button type="submit">Atualizar</button>
</form>
