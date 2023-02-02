<script>
  import { onMount } from "svelte";
  import { requestdataapi } from "./../sharefunc.js";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { navigate, Router, Link, Route } from "svelte-navigator";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data")) || {};
  // _data.post = _data.post || {};
  // _data.post.error = _data.post.error || [];

  let fields = {
    id: "",
    groupId: "",
    groupName: "",
    groupAddress: "",
    sitePageUrl: "",
  };
  let pageloading;

  onMount(async () => {
    _data.post = {};
    fields.groupId = _data.user.data.groupId;
    fields.groupName = _data.user.data.groupName;
    fields.groupAddress = _data.user.data.groupAddress;
    fields.sitePageUrl = _data.user.data.sitePageUrl;
  });

  const submitHandler = async () => {
    pageloading = true;
    _data.post = {};
    let apioutput = requestdataapi({
      action: "GroupRegister",
      groupId: fields.groupId,
      groupName: fields.groupName,
      groupAddress: fields.groupAddress,
      sitePageUrl: fields.sitePageUrl,
    });

    let newuser = (await apioutput).mypwp_user;
    data.update((currentPolls) => {
      _data = currentPolls;
      _data.user = newuser;
      localStorage.setItem("_data", JSON.stringify(_data));
      return _data;
    });

    _data.post = (await apioutput).submitpost;
    // console.log("_data.post", _data.post);
    pageloading = false;
  };
</script>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3>Group Register</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Group</li>
          <li class="breadcrumb-item active">Register</li>
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
    <strong>Success!</strong> You register your group Name. <br />
    Your Next Step is <Link to={_data.mylinkurl + "/ProfileRegister"}>
      <i data-feather="airplay" /><span class="fw-bold text-white"
        >Profile Register</span
      ></Link
    >
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
          <form id="contactForm" on:submit|preventDefault={submitHandler}>
            <input
              class="form-control"
              id="id"
              type="hidden"
              bind:value={fields.id}
            />
            <input
              class="form-control"
              id="groupId"
              type="hidden"
              bind:value={fields.groupId}
            />
            <div class="mb-3">
              <label class="form-label" for="groupName">Group Name</label>
              <input
                class="form-control {_data.post &&
                _data.post.error &&
                _data.post.error.findIndex((p) =>
                  p.hasOwnProperty('groupName')
                ) != -1
                  ? 'is-invalid'
                  : ''}"
                id="groupName"
                type="text"
                placeholder=""
                required
                data-sb-validations="required"
                bind:value={fields.groupName}
              />
              <div
                class="invalid-feedback"
                data-sb-feedback="groupName:required"
              >
                Group Name is required.
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="groupAddress">Group Address</label>
              <textarea
                class="form-control"
                id="groupAddress"
                type="text"
                placeholder=""
                style="height: 10rem;"
                data-sb-validations="required"
                required
                bind:value={fields.groupAddress}
              />
              <div
                class="invalid-feedback"
                data-sb-feedback="groupAddress:required"
              >
                Group Address is required.
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="sitePageUrl">Site Page URL</label>
              <input
                class="form-control {_data.post &&
                _data.post.error &&
                _data.post.error.findIndex((p) =>
                  p.hasOwnProperty('sitePageUrl')
                ) != -1
                  ? 'is-invalid'
                  : ''}"
                id="sitePageUrl"
                type="text"
                placeholder=""
                data-sb-validations="required"
                bind:value={fields.sitePageUrl}
                required
              />
              <div
                class="invalid-feedback"
                data-sb-feedback="sitePageUrl:required"
              >
                Site Page URL is required.
              </div>
            </div>

            <div class="d-grid">
              <button
                class="btn btn-primary btn-lg"
                id="submitButton"
                type="submit">Submit</button
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
