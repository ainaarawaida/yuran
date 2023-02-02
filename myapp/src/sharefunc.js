

import { data } from "./store.js";
import { useParams, navigate, Router, Link, Route } from "svelte-navigator";
let luq;
let _data ;
_data = JSON.parse(localStorage.getItem("_data")) || {};
data.update((currentPolls) => {
  _data = currentPolls;
  return _data;
});


const requestdataapi = async (inputs) => {


  let apidata = new Promise(function (myResolve, myReject) {
    let dataArray = new FormData();
    let dataHeader = new Headers();

    for (let input of Object.keys(inputs) ){
      dataArray.append(input, inputs[input]);
    }

    fetch(`${_data.myapiurl}/data`, {
      method: "POST",
      body: dataArray,
      // headers: dataHeader,
    })
      .then((response) => {
          return response.json();
      })
      .then((result) => {
        myResolve(result);
      })
      .catch((error) => {
        console.log("error", error);
      });
  });

  return JSON.parse(await apidata);

};


  luq = (var1) => {
    console.log("hai",var1);
  } 



export {luq, requestdataapi}