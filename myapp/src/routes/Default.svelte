<script>
  import { onMount } from "svelte";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { navigate, Router, Link, Route } from "svelte-navigator";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data")) || {};

  onMount(async () => {
    // if (
    //   _data.user &&
    //   _data.user.data &&
    //   _data.user.data.stageDaftar &&
    //   _data.user.data.stageDaftar == "0"
    // ) {
    //   navigate(_data.mylinkurl + "/GroupRegister");
    //   // location.reload();
    // } else {
    //   // navigate(_data.mylinkurl + "/Dashboard");
    //   // location.reload();
    // }
  });
</script>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3>Register Group</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Group</li>
          <li class="breadcrumb-item active">Register</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header pb-0">
          <h5>Default Title</h5>
        </div>
        <div class="card-body">Content</div>
      </div>
    </div>
  </div>
</div>
