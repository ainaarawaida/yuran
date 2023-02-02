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

  let fields = {
    id: "",
    profileId: "",
    profileFullName: "",
    profileEmail: "",
    profilePassword: "",
    profilePasswordAgain: "",
    profileIc: "",
    profileTelno: "",
    profileRegisterDate: "",
    profileMemberId: "",
    profileMemberType: "",
    groupName: "",
  };

  let pageloading;

  onMount(async () => {
    _data.post = {};
    let year = new Date().toISOString().substring(0, 4);
    let month = new Date().toISOString().substring(5, 7);
    let day = new Date().toISOString().substring(8, 10);
    fields.profileFullName = _data.user.data.display_name;
    fields.profileEmail = _data.user.data.user_email;
    fields.profileRegisterDate = [year, month, day].join("-");
    fields.profileMemberId = _data.user.data.memberId;
    fields.profileMemberType = _data.user.data.role == 1 ? "Admin" : "Member";
    fields.groupName = _data.user.data.groupName;
    fields.profileIc = _data.user.data.memberIc;
    fields.profileTelno = _data.user.data.memberTelno;
    fields.profileId = _data.user.ID;
  });

  const submitHandler = async () => {
    pageloading = true;
    _data.post = {};
    let apioutput = requestdataapi({
      action: "ProfileRegister",
      profileId: fields.profileId,
      profileFullName: fields.profileFullName,
      profileEmail: fields.profileEmail,
      profilePassword: fields.profilePassword,
      profilePasswordAgain: fields.profilePasswordAgain,
      profileIc: fields.profileIc,
      profileTelno: fields.profileTelno,
      profileRegisterDate: fields.profileRegisterDate,
      profileMemberId: fields.profileMemberId,
      profileMemberType: fields.profileMemberType,
      groupName: fields.groupName,
    });

    let newuser = (await apioutput).mypwp_user;
    data.update((currentPolls) => {
      _data = currentPolls;
      _data.user = newuser;
      localStorage.setItem("_data", JSON.stringify(_data));
      return _data;
    });
    _data.post = (await apioutput).submitpost;

    pageloading = false;
  };
</script>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3>Profile Register</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Profile</li>
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
    <strong>Success!</strong> register your profile
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
              id="profileId"
              type="hidden"
              bind:value={fields.profileId}
            />
            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="profileFullName">Full Name</label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileFullName')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileFullName"
                  type="text"
                  placeholder=""
                  required
                  bind:value={fields.profileFullName}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileFullName:required"
                >
                  Nama Penuh is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="profileEmail">Email</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileEmail')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileEmail"
                  type="profileEmail"
                  placeholder=""
                  required
                  bind:value={fields.profileEmail}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileEmail:required"
                >
                  Email is required.
                </div>
                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileEmail:email"
                >
                  Email is not valid.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="profilePassword"
                  >Password <i>(leave it if you don't want to change)</i></label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profilePassword')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profilePassword"
                  type="profilePassword"
                  placeholder=""
                  bind:value={fields.profilePassword}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profilePassword:required"
                >
                  password is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="profilePasswordAgain"
                  >Verify Password <i>(leave it if you don't want to change)</i
                  ></label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profilePasswordAgain')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profilePasswordAgain"
                  type="password"
                  placeholder=""
                  bind:value={fields.profilePasswordAgain}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profilePasswordAgain:required"
                >
                  Password Confirmation is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="profileIc">Ic Number</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileIc')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileIc"
                  type="number"
                  min="100000000000"
                  max="999999999999"
                  placeholder=""
                  required
                  bind:value={fields.profileIc}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileIc:required"
                >
                  IC Number is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="profileTelno">Telephone No</label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileTelno')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileTelno"
                  type="number"
                  placeholder=""
                  required
                  bind:value={fields.profileTelno}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileTelno:required"
                >
                  Telephone No. is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="profileRegisterDate"
                  >Registration Date</label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileRegisterDate')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileRegisterDate"
                  type="date"
                  placeholder=""
                  required
                  bind:value={fields.profileRegisterDate}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileRegisterDate:required"
                >
                  Register Date is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="profileMemberId">Member Id</label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('profileMemberId')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileMemberId"
                  type="text"
                  placeholder=""
                  required
                  bind:value={fields.profileMemberId}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileMemberId:required"
                >
                  Member Id is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="profileMemberType"
                  >Member Type</label
                >
                <input
                  readonly
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('jenisAhli')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="profileMemberType"
                  type="text"
                  placeholder=""
                  required
                  bind:value={fields.profileMemberType}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="profileMemberType:required"
                >
                  Jenis Ahli is required.
                </div>
                <input
                  type="hidden"
                  id="jenisAhli"
                  bind:value={fields.jenisAhli}
                />
              </div>
              <div class="col-sm">
                <label class="form-label" for="groupName">Group</label>
                <input
                  readonly
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
                  bind:value={fields.groupName}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="groupName:required"
                >
                  Group is required.
                </div>
              </div>
            </div>

            <div class="m-5" />
            <br />

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
