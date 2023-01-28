<script>
  import { onMount } from "svelte";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { getContext } from "svelte";
  import { navigate, Router, Link, Route } from "svelte-navigator";
  let mypluginurl = getContext("mypluginurl");
  let mybaseurl = getContext("mybaseurl");
  let mylinkurl = getContext("mylinkurl");
  let _data;
  data.update((currentPolls) => {
    _data = currentPolls;
    return currentPolls;
  });
  onMount(async () => {
    data.update((currentPolls) => {
      _data.loading = false;
      localStorage.setItem("_data", JSON.stringify(_data));
      return currentPolls;
    });

    if (!_data.user || (_data.user && Object.keys(_data.user).length == 0)) {
      navigate(mylinkurl + "/mylogin");
      location.reload();
    }

    // setTimeout(async () => {
    // await loadScript(`${mypluginurl}/assets/js/oneui.app.min.js`);
    // console.log("oneui.app.min.js11");
    // }, 5100);
  });
</script>

home
