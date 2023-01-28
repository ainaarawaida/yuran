<script>
  import { onMount } from "svelte";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { getContext } from "svelte";
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
  });
</script>

home
