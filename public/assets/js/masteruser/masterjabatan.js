// main
    var store = new DevExpress.data.CustomStore({
        key: "id_jabatan",
        load: function() {
            return sendRequest(apiurl + "/master-jabatan");
        },
        insert: function(values) {
            return sendRequest(apiurl + "/master-jabatan", "POST", values);
        },
        update: function(key, values) {
            return sendRequest(apiurl + "/master-jabatan/"+key, "PUT", values);
        },
        remove: function(key) {
            return sendRequest(apiurl + "/master-jabatan/"+key, "DELETE");
        }
    });

    // attribute
    var dataGrid = $("#master-jabatan").dxDataGrid({    
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
            mode: "cell",
            allowAdding: true,
            allowUpdating: true,
            allowDeleting: true,
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
                dataField: "nama_jabatan",
                validationRules: [
                    { type: "required" }
                ]
            },        
           
        ],
        export: {
            enabled: true,
            fileName: "master-jabatan",
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