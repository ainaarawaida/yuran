(function($) {
    "use strict";

    let getdata = JSON.parse(localStorage.getItem('_data')).submitpost.post ;
    console.log("getdatahead",getdata.mydatatablehead);
    console.log("getdata",getdata.mydatatable);
 
    
    var db = {
        loadData: function(filter) {
            return $.grep(this.clients, function(client) {
             
                return (!filter[0] || client[0] == filter[0])
                    && (!filter[1] || client[1] == filter[1])
                    && (!filter[2] || client[2] == filter[2])
                    && (!filter[3] || client[3] == filter[3])
                    && (!filter[4] || client[4] == filter[4])
                    && (!filter[5] || client[5] == filter[5]);
            });
        },
        insertItem: function(insertingClient) {
            this.clients.push(insertingClient);
        },
        updateItem: function(updatingClient) { },

        deleteItem: function(deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1);
        }
    };

    db.clients = getdata.mydatatable;
    let newfield = [];
    for(let i = 0 ; i <  getdata.mydatatablehead.length ; i++){
        newfield.push({ name: `${i}`, type: "text", title: getdata.mydatatablehead[i],sorting: false })
    }
    newfield.push({ type: "control" });

    $("#basicScenario").jsGrid({
        width: "100%",
        filtering: true,
        editing: true,
        inserting: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the data?",
        controller: db,
        fields: newfield
    });
    

    var selectedItems = [];
    var selectItem = function(item) {
        selectedItems.push(item);
    };
    var unselectItem = function(item) {
        selectedItems = $.grep(selectedItems, function(i) {
            return i !== item;
        });
    };
    var deleteSelectedItems = function() {
        if(!selectedItems.length || !confirm("Are you sure?"))
            return;
        deleteClientsFromDb(selectedItems);
        var $grid = $("#batchDelete");
        $grid.jsGrid("option", "pageIndex", 1);
        $grid.jsGrid("loadData");
        selectedItems = [];
    };
    var deleteClientsFromDb = function(deletingClients) {
        db.clients = $.map(db.clients, function(client) {
            return ($.inArray(client, deletingClients) > -1) ? null : client;
        });
    };


    
let ele4 =document.querySelector("#submit_generatelppsadata");
if(ele4){
  ele4.addEventListener("click", function(e){ 
      console.log("ddddd", db.clients)
  }); 
}


})(jQuery);



