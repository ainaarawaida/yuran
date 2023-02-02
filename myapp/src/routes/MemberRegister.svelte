<script>
  import { onMount } from "svelte";
  import { requestdataapi } from "./../sharefunc.js";
  import { data } from "./../store.js";
  import { onDestroy } from "svelte";
  import { loadScript } from "./../document.js";
  import { useParams, navigate, Router, Link, Route } from "svelte-navigator";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data")) || {};
  const params = useParams();

  let fields = {
    id: "",
    memberId: "",
    memberFullName: "",
    memberEmail: "",
    memberPassword: "",
    memberPasswordAgain: "",
    memberIc: "",
    memberTelno: "",
    memberRegisterDate: "",
    memberType: "",
    groupName: "",
    groupId: "",
  };

  let pageloading;

  onMount(async () => {
    _data.post = {};
    pageloading = true;
    if ($params.param) {
      let apioutput = requestdataapi({
        action: "GetMemberRegister",
        id: $params.param,
      });
      _data.post = (await apioutput).submitpost;
      // console.log("_data.post", _data.post);
      fields.id = _data.post.getMemberData[0].ID;

      let year = _data.post.getMemberData[0].memberRegisterDate.substring(0, 4);
      let month = _data.post.getMemberData[0].memberRegisterDate.substring(
        5,
        7
      );
      let day = _data.post.getMemberData[0].memberRegisterDate.substring(8, 10);
      fields.memberRegisterDate = [year, month, day].join("-");
      fields.groupName = _data.post.getMemberData[0].groupName;
      fields.groupId = _data.post.getMemberData[0].groupId;

      fields.memberId = _data.post.getMemberData[0].memberId;
      fields.memberFullName = _data.post.getMemberData[0].memberFullName;
      fields.memberEmail = _data.post.getMemberData[0].memberEmail;
      fields.memberIc = _data.post.getMemberData[0].memberIc;
      fields.memberTelno = _data.post.getMemberData[0].memberTelno;
      fields.memberType = _data.post.getMemberData[0].role;
    } else {
      let year = new Date().toISOString().substring(0, 4);
      let month = new Date().toISOString().substring(5, 7);
      let day = new Date().toISOString().substring(8, 10);
      fields.memberRegisterDate = [year, month, day].join("-");
      fields.groupName = _data.user.data.groupName;
      fields.groupId = _data.user.data.groupId;
    }

    pageloading = false;
  });

  onDestroy(() => {});

  const submitHandler = async () => {
    pageloading = true;
    _data.post = {};
    let apioutput = requestdataapi({
      action: "MemberRegister",
      id: fields.id,
      memberId: fields.memberId,
      memberFullName: fields.memberFullName,
      memberEmail: fields.memberEmail,
      memberPassword: fields.memberPassword,
      memberPasswordAgain: fields.memberPasswordAgain,
      memberIc: fields.memberIc,
      memberTelno: fields.memberTelno,
      memberRegisterDate: fields.memberRegisterDate,
      memberType: fields.memberType,
      groupName: fields.groupName,
      groupId: fields.groupId,
    });

    let newuser = (await apioutput).mypwp_user;
    data.update((currentPolls) => {
      _data = currentPolls;
      _data.user = newuser;
      localStorage.setItem("_data", JSON.stringify(_data));
      return _data;
    });
    _data.post = (await apioutput).submitpost;
    if (_data.post && _data.post.error && _data.post.error.length == 0) {
      navigate(_data.mylinkurl + "/MemberList");
    }

    pageloading = false;
  };

  const newMemberRegister = async () => {
    navigate(_data.mylinkurl + "/MemberRegister");
    fields = {
      id: "",
      memberId: "",
      memberFullName: "",
      memberEmail: "",
      memberPassword: "",
      memberPasswordAgain: "",
      memberIc: "",
      memberTelno: "",
      memberRegisterDate: "",
      memberType: "",
      groupName: "",
      groupId: "",
    };
    let year = new Date().toISOString().substring(0, 4);
    let month = new Date().toISOString().substring(5, 7);
    let day = new Date().toISOString().substring(8, 10);
    fields.memberRegisterDate = [year, month, day].join("-");
    fields.groupName = _data.user.data.groupName;
    fields.groupId = _data.user.data.groupId;
  };
</script>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3>Member Register {$params.param ? `Update` : ``}</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Member</li>
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
          <div class="text-end">
            <a
              class="btn btn-primary"
              href="/"
              on:click|preventDefault={() => newMemberRegister()}
              >New Member Register</a
            >
          </div>

          <form id="contactForm" on:submit|preventDefault={submitHandler}>
            <input
              class="form-control"
              id="id"
              type="hidden"
              bind:value={fields.id}
            />
            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="memberFullName">Full Name</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberFullName')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberFullName"
                  type="text"
                  placeholder=""
                  required
                  bind:value={fields.memberFullName}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberFullName:required"
                >
                  Nama Penuh is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="memberEmail">Email</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberEmail')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberEmail"
                  type="memberEmail"
                  placeholder=""
                  required
                  bind:value={fields.memberEmail}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberEmail:required"
                >
                  Email is required.
                </div>
                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberEmail:email"
                >
                  Email is not valid.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="memberPassword"
                  >Password <i>(leave it if you don't want to change)</i></label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberPassword')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberPassword"
                  type="memberPassword"
                  placeholder=""
                  bind:value={fields.memberPassword}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberPassword:required"
                >
                  password is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="memberPasswordAgain"
                  >Verify Password <i>(leave it if you don't want to change)</i
                  ></label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberPasswordAgain')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberPasswordAgain"
                  type="password"
                  placeholder=""
                  bind:value={fields.memberPasswordAgain}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberPasswordAgain:required"
                >
                  Password Confirmation is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="memberIc">Ic Number</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberIc')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberIc"
                  type="number"
                  min="100000000000"
                  max="999999999999"
                  placeholder=""
                  required
                  bind:value={fields.memberIc}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberIc:required"
                >
                  IC Number is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="memberTelno">Telephone No</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberTelno')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberTelno"
                  type="number"
                  placeholder=""
                  required
                  bind:value={fields.memberTelno}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberTelno:required"
                >
                  Telephone No. is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="memberRegisterDate"
                  >Registration Date</label
                >
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberRegisterDate')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberRegisterDate"
                  type="date"
                  placeholder=""
                  required
                  bind:value={fields.memberRegisterDate}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberRegisterDate:required"
                >
                  Register Date is required.
                </div>
              </div>
              <div class="col-sm">
                <label class="form-label" for="memberId">Member Id</label>
                <input
                  class="form-control {_data.post &&
                  _data.post.error &&
                  _data.post.error.findIndex((p) =>
                    p.hasOwnProperty('memberId')
                  ) != -1
                    ? 'is-invalid'
                    : ''}"
                  id="memberId"
                  type="text"
                  placeholder="Please Empty for auto generated"
                  bind:value={fields.memberId}
                />

                <div
                  class="invalid-feedback"
                  data-sb-feedback="memberId:required"
                >
                  Member Id is required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label class="form-label" for="memberType">Member Type</label>
                <select
                  bind:value={fields.memberType}
                  class="form-control"
                  id="memberType"
                  name="memberType"
                  required
                >
                  <option value="">Select Type</option>
                  <option value="1">Admin</option>
                  <option value="2">Member</option>
                </select>
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
                <input
                  type="hidden"
                  name="groupid"
                  bind:value={fields.groupId}
                />
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
