<script>
  import { onMount } from "svelte";
  import { onDestroy } from "svelte";
  import { data } from "./../store.js";
  import { navigate, Router, Link, Route } from "svelte-navigator";
  import { globalHistory } from "svelte-navigator/src/history";
  let _data;
  let pathname = window.location.pathname;
  let unsub_Mystep;
  let unsubscribe_data_Mystep = data.subscribe((value) => {
    _data = value;
  });

  onMount(async () => {});
  onDestroy(() => {
    unsubscribe_data_Mystep();
    unsub_Mystep();
  });

  unsub_Mystep = globalHistory.listen(({ location, action }) => {
    pathname = location.pathname;
  });

  $: if (
    _data.user &&
    _data.user.data &&
    _data.user.data.stageDaftar &&
    _data.user.data.stageDaftar == "0" &&
    pathname != _data.mylinkurl + "/GroupRegister"
  ) {
    const myTimeout = setTimeout(function myStopFunction() {
      // console.log("GroupRegister");
      navigate(_data.mylinkurl + "/GroupRegister");
    }, 100);

    // location.reload();
  } else if (
    _data.user &&
    _data.user.data &&
    _data.user.data.stageDaftar &&
    _data.user.data.stageDaftar == "1" &&
    pathname != _data.mylinkurl + "/ProfileRegister" &&
    pathname != _data.mylinkurl + "/GroupRegister"
  ) {
    const myTimeout = setTimeout(function myStopFunction() {
      // console.log("ProfileRegister");
      navigate(_data.mylinkurl + "/ProfileRegister");
    }, 100);

    // location.reload();
  }
</script>

<main>
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col">
        <div class="text-center"><h1>Step</h1></div>
        <div class="row">
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            1
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            1.Group Register
          </div>
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            2
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            2.Profile Register
          </div>
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            3
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            3.Member Register
          </div>
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            4
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            4.Kelulusan Admin
          </div>
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            5
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            5.Bayaran
          </div>
          <div
            class="text-center col-sm p-2 m-1 bg-{_data.user.data.stageDaftar >=
            6
              ? 'success'
              : 'danger'} text-white progress-bar-striped"
          >
            6.Kematian
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
