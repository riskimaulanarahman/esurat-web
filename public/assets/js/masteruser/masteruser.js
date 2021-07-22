// main
    var store = new DevExpress.data.CustomStore({
        key: "id",
        load: function() {
            return sendRequest(apiurl + "/master-user");
        },
        insert: function(values) {
            return sendRequest(apiurl + "/master-user", "POST", values);
        },
        update: function(key, values) {
            return sendRequest(apiurl + "/master-user/"+key, "PUT", values);
        },
        remove: function(key) {
            return sendRequest(apiurl + "/master-user/"+key, "DELETE");
        }
    });

    RoleType = [{id:1,roletype:"admin"},{id:2,roletype:"user"}];
    // attribute
    var dataGrid = $("#master-user").dxDataGrid({    
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
            allowAdding: true,
            allowUpdating: true,
            allowDeleting: true,
            popup: {
                title: "User Info",
                showTitle: true,
                width: 700,
                height: 525,
                position: {
                    my: "center",
                    at: "center",
                    of: window
                }
            },
            form: {
                items: [{
                    itemType: "group",
                    colCount: 2,
                    colSpan: 2,
                    items: [
                        {
                            dataField: "nik",
                        },
                        { 
                            dataField: "jabatan",
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
                            // visible: false,
                        },
                        {
                            dataField: "no_hp",
                            // visible: false,
                        }
                    ]
                }, {
                    itemType: "group",
                    colCount: 2,
                    colSpan: 2,
                    caption: "Login Info",
                    items: ["role","username","email","password"]
                }]
            }
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
                validationRules: [
                    { type: "required" }
                ]
            },
            
            { 
                dataField: "username",
                caption: "username",
                validationRules: [
                    { type: "required" }
                ]
            },
            { 
                dataField: "password",
                visible: false,
            },
            { 
                dataField: "email",
                validationRules: [
                    { 
                        type: "required" 
                    }
                ]
            },
            { 
                dataField: "role",
                editorType: "dxSelectBox",
                validationRules: [
                    { type: "required" }
                ],
                editorOptions: {
                    dataSource: RoleType,  
                    valueExpr: 'roletype',
                    displayExpr: 'roletype',
                },
            },
            
            { 
                dataField: "jabatan",
                visible: false,
            },
            { 
                dataField: "nama_karyawan",
                visible: false,
            },
            { 
                dataField: "alamat",
                visible: false,
            },
            { 
                dataField: "no_hp",
                visible: false,
            },
           
        ],
        export: {
            enabled: true,
            fileName: "master-user",
            excelFilterEnabled: true,
            allowExportSelectedData: true
        },
        onEditorPreparing: function(e) {
            if (e.dataField === "password" && e.parentType === "dataRow") {
                e.editorOptions.value = "";
            }
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