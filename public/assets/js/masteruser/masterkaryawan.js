// main
var store = new DevExpress.data.CustomStore({
    key: "id_karyawan",
    load: function() {
        return sendRequest(apiurl + "/master-karyawan");
    },
    insert: function(values) {
        return sendRequest(apiurl + "/master-karyawan", "POST", values);
    },
    update: function(key, values) {
        return sendRequest(apiurl + "/master-karyawan/"+key, "PUT", values);
    },
    remove: function(key) {
        return sendRequest(apiurl + "/master-karyawan/"+key, "DELETE");
    }
});

// attribute
var dataGrid = $("#master-karyawan").dxDataGrid({    
    dataSource: store,
    columnsAutoWidth: false,
    columnHidingEnabled: false,
    showBorders: true,
    filterRow: { visible: true },
    filterPanel: { visible: true },
    headerFilter: { visible: true },
    selection: {
        mode: "multiple"
    },
    editing: {
        mode: "popup",
        allowAdding: false,
        allowUpdating: true,
        allowDeleting: false,
    },
    scrolling: {
        mode: "virtual"
    },
    columns: [
        {
            caption: '#',
            formItem: { 
                visible: false
            },
            width: 40,
            cellTemplate: function(container, options) {
                container.text(options.rowIndex +1);
            }
        },
        { 
            dataField: "nik",
            formItem: { 
                visible: false
            },
            validationRules: [
                { type: "required" }
            ]
        },    
        // {
        //     dataField: "id_jabatan",
        // },  
        { 
            caption: "jabatan",
            dataField: "id_jabatan",
            editorType: "dxSelectBox",
            // validationRules: [
            //     { type: "required" }
            // ],
            editorOptions: {
                dataSource: listJabatan,  
                valueExpr: 'id_jabatan',
                displayExpr: 'nama_jabatan',
            },
        },
        {
            dataField: "nama_karyawan",
        },
        {
            dataField: "alamat",
        },
        {
            dataField: "no_hp",
        },
       
    ],
    export: {
        enabled: true,
        fileName: "master-karyawan",
        excelFilterEnabled: true,
        allowExportSelectedData: true
    },
    onToolbarPreparing: function(e) {
        dataGrid = e.component;

        e.toolbarOptions.items.unshift({						
            location: "after",
            widget: "dxButton",
            options: {
                hint: "Refresh Data",
                icon: "refresh",
                onClick: function() {
                    dataGrid.refresh();
                }
            }
        })
    },
}).dxDataGrid("instance");