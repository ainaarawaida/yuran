<script>
  import { onMount } from "svelte";
  import { requestdataapi } from "./../sharefunc.js";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { useParams, navigate, Router, Link, Route } from "svelte-navigator";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data")) || {};
  // _data.post = _data.post || {};

  let pageloading;
  let postvalidate = "tiada";
  let checkelement;
  let pathname = window.location.pathname;
  let mydatatablevar;
  const params = useParams();
  let unsubscribe_data_MemberList;

  unsubscribe_data_MemberList = data.subscribe((value) => {
    _data = value;
  });

  onMount(async () => {
    pageloading = true;
    checkelement = document.querySelector("#mydatatable");

    _data.post = {};
    console.log("$params", $params);
    let apioutput = requestdataapi({
      action: "MemberList",
      groupId: _data.user.data.groupId,
    });

    _data.post = (await apioutput).submitpost;
    console.log("_data.post", _data.post);
    pageloading = false;
  });

  onDestroy(() => {
    unsubscribe_data_MemberList();
    let mytableremove = document.querySelector("#mydatatable_wrapper");
    if (mytableremove) {
      mytableremove.remove();
    }
  });

  const submitHandler = async () => {};

  $: if (
    _data.loadscript === true &&
    pathname.includes(_data.mylinkurl + "/MemberList") &&
    checkelement &&
    postvalidate == "tiada" &&
    pageloading == false
  ) {
    postvalidate = "ada";
    (function ($) {
      let mydata = _data.post.getMemberList || [];
      let title = [
        { title: "ID", data: "ID" },
        { title: "groupName", data: "groupName" },
        { title: "memberEmail", data: "memberEmail" },
        { title: "memberFullName", data: "memberFullName" },
        { title: "memberIc", data: "memberIc" },
        { title: "memberId", data: "memberId" },
        { title: "memberRegisterDate", data: "memberRegisterDate" },
        { title: "memberTelno", data: "memberTelno" },
        { title: "role", data: "role" },
        { title: "stageDaftar", data: "stageDaftar" },
      ];

      mydatatablevar = $("#mydatatable").DataTable({
        ordering: true,
        dom: "Bfrtip",
        select: true,
        scrollX: true,
        scrollY: "500px",
        scrollCollapse: true,
        lengthMenu: [
          [10, 25, 50, -1],
          ["10 rows", "25 rows", "50 rows", "Show all"],
        ],
        buttons: [
          "csv",
          "excel",
          "pdf",
          "print",
          {
            extend: "collection",
            text: "Action",
            buttons: [
              {
                text: "View Data",
                action: function (e, dt, node, config) {
                  navigate(
                    `${_data.mylinkurl}/MemberRegister/${
                      dt.row({ selected: true }).data()["ID"]
                    }`
                  );
                },
                enabled: false,
              },
              {
                text: "Compare Cagamas Data",
                action: function (e, dt, node, config) {
                  // console.log(dt.row( { selected: true } ).data()[0])
                  navigate(
                    `${_data.mylinkurl}/ViewCagamasDataProses/${
                      dt.row({ selected: true }).data()["cagamasfileid"]
                    }`
                  );
                },
                enabled: false,
              },
            ],
          },
          "colvis",
          "pageLength",
        ],
        initComplete: function (settings, json) {
          $("#loading").hide();
        },
        data: mydata,
        columns: title,
      });

      // mydatatablevar.MakeCellsEditable({
      //   onUpdate: myCallbackFunction,
      // });

      mydatatablevar.on("select deselect", function () {
        var selectedRows = mydatatablevar.rows({ selected: true }).count();

        mydatatablevar.button("4-0").enable(selectedRows === 1);
        mydatatablevar.button("4-1").enable(selectedRows === 1);
      });

      function myCallbackFunction(updatedCell, updatedRow, oldValue) {}
    })(jQuery);
  }
</script>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3>Member List</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Member</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </div>
    </div>
  </div>
</div>

{#if pageloading === true}
  <!-- Loader starts-->
  <div
    class=""
    style="z-index:100; position: absolute;left: 50%;transform: translate(-50%, 0);"
  >
    <img class="" src="{_data.mypluginurl}/loading.gif" alt="" />
  </div>
  <!-- Loader ends-->
{/if}
{#if _data.post && _data.post.error && _data.post.error.length == 0}
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You register your group Name
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"
    />
  </div>
{:else if _data.post && _data.post.error && _data.post.error.length > 0}
  {#each _data.post.error as error}
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>
      {Object.values(error)}
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      />
    </div>
  {/each}
{/if}

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <!-- <div class="card-header pb-0">
          <h5>Default Title</h5>
        </div> -->
        <div class="card-body">
          <table id="mydatatable" class="display" width="100%" />
        </div>
      </div>
    </div>
  </div>
</div>
