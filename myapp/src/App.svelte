<script>
  import { navigate, Router, Link, Route } from "svelte-navigator";
  import { requestdataapi } from "./sharefunc.js";
  import { onMount } from "svelte";
  import { data } from "./store.js";
  import { onDestroy } from "svelte";

  let _data;
  let unsubscribe_data;
  let myapiurl = import.meta.env.VITE_MYAPIURL;
  let mylinkurl = import.meta.env.VITE_MYLINKURL;
  let mypluginurl = import.meta.env.VITE_MYPLUGINURL;
  let mybaseurl = import.meta.env.VITE_MYBASEURL;

  import Default from "./routes/Default.svelte";
  import Header from "./routes/Header.svelte";
  import Sidebar from "./routes/Sidebar.svelte";
  import Footer from "./routes/Footer.svelte";
  import Home from "./routes/Home.svelte";

  import Mystep from "./routes/Mystep.svelte";
  import Dashboard from "./routes/Dashboard.svelte";
  import GroupRegister from "./routes/GroupRegister.svelte";
  import ProfileRegister from "./routes/ProfileRegister.svelte";
  import MemberRegister from "./routes/MemberRegister.svelte";
  import MemberList from "./routes/MemberList.svelte";

  _data = JSON.parse(localStorage.getItem("_data")) || {};
  unsubscribe_data = data.subscribe((value) => {
    _data = value;
  });

  _data.loading = true;
  _data.loadscript = false;
  _data.myapiurl = myapiurl;
  _data.mylinkurl = mylinkurl;
  _data.mypluginurl = mypluginurl;
  _data.mybaseurl = mybaseurl;
  localStorage.setItem("_data", JSON.stringify(_data));

  onMount(async () => {
    let apioutput = requestdataapi({
      action: "GetUserData",
    });

    _data.user = (await apioutput).mypwp_user;
    localStorage.setItem("_data", JSON.stringify(_data));

    _data.loading = false;
  });

  onDestroy(() => {
    unsubscribe_data();
  });

  $: console.log("_data", _data);
</script>

<Router primary={false}>
  {#if _data.loading === true}
    <!-- Loader starts-->
    <div class="d-flex justify-content-center">
      <img class="" src="{_data.mypluginurl}/loading.gif" alt="" />
    </div>
    <!-- Loader ends-->
  {:else if _data.loading === false}
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <Header />
      <div class="page-body-wrapper sidebar-icon">
        <Sidebar />
        <div class="page-body dashboard-2-main">
          <!-- Container-fluid starts-->
          <Mystep />
          <Route path={_data.mylinkurl + "/"}>
            <Home />
          </Route>
          <Route path={_data.mylinkurl + "/Dashboard"}>
            <Dashboard />
          </Route>
          <Route path={_data.mylinkurl + "/GroupRegister"}>
            <GroupRegister />
          </Route>
          <Route path={_data.mylinkurl + "/ProfileRegister"}>
            <ProfileRegister />
          </Route>
          <Route path={_data.mylinkurl + "/MemberRegister/*param"}>
            <MemberRegister />
          </Route>
          <Route path={_data.mylinkurl + "/MemberList/*param"}>
            <MemberList />
          </Route>

          <Route>
            <Default />
          </Route>

          <!-- Container-fluid Ends-->
        </div>
        <Footer />
      </div>
    </div>
  {/if}
</Router>
