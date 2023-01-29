<script>
  import { onMount } from "svelte";
  import { requestdataapi } from "./../sharefunc.js";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { navigate, Router, Link, Route } from "svelte-navigator";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data"));

  let fields = {
    id: "",
    idGroup: "",
    nameGroup: "",
    addressGroup: "",
    sitePageUrl: "",
  };
  let pageloading;

  onMount(async () => {});

  const submitHandler = async () => {
    pageloading = true;
    let apioutput = requestdataapi({
      action: "RegisterGroup",
      idGroup: fields.idGroup,
      nameGroup: fields.nameGroup,
      addressGroup: fields.addressGroup,
      sitePageUrl: fields.sitePageUrl,
    });

    _data.post = (await apioutput).post;
    console.log("_data.post", _data.post);

    _data.loading = false;
  };
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
              id="idGroup"
              type="hidden"
              bind:value={fields.idGroup}
            />
            <div class="mb-3">
              <label class="form-label" for="nameGroup">Nama Kariah</label>
              <input
                class="form-control"
                id="nameGroup"
                type="text"
                placeholder="Nama Kariah"
                required
                data-sb-validations="required"
                bind:value={fields.nameGroup}
              />
              <div
                class="invalid-feedback"
                data-sb-feedback="nameGroup:required"
              >
                Nama Kariah is required.
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="addressGroup">Alamat Kariah</label>
              <textarea
                class="form-control"
                id="addressGroup"
                type="text"
                placeholder="Alamat Kariah"
                style="height: 10rem;"
                data-sb-validations="required"
                required
                bind:value={fields.addressGroup}
              />
              <div
                class="invalid-feedback"
                data-sb-feedback="addressGroup:required"
              >
                Alamat Kariah is required.
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="sitePageUrl">Site Page URL</label>
              <input
                class="form-control"
                id="sitePageUrl"
                type="text"
                placeholder="Site Page URL"
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
