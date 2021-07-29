$(document).ready(function(){
    role = $('.roleuser').val();
    $.getJSON(apiurl + "/getdetail-disposisi?module=suratkeluar",function(item){

    var store = new DevExpress.data.CustomStore({
        key: "id_surat_keluar",
        load: function() {
            return sendRequest(apiurl + "/surat-keluar");
        },
        insert: function(values) {
            return sendRequest(apiurl + "/surat-keluar", "POST", values);
        },
        update: function(key, values) {
            return sendRequest(apiurl + "/surat-keluar/"+key, "PUT", values);
        },
        remove: function(key) {
            return sendRequest(apiurl + "/surat-keluar/"+key, "DELETE");
        }
    });
    
    function moveEditColumnToLeft(dataGrid) {
		dataGrid.columnOption("command:edit", { 
			visibleIndex: -1,
			width: 80 
		});
    }

    var id = {},
        popup = null,
        popupOptions = {
            width: 500,
            height: 450,
            contentTemplate: function() {
                return $("<div />").append(
                    $("<p>Title: <span>" + title + "</span></p>"),
                    $("<div>").attr("id", "formupload").dxFileUploader({
                        uploadMode: "useButtons",
                        name: "file",
                        uploadUrl: "/api/upload-berkas/"+id+"/suratkeluar",
                        accept: "image/*,application/pdf,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                        onUploaded: function (e) {						
                            dataGrid.refresh();
                        }
                    })
                );
            },
            showTitle: true,
            title: "Upload Form",
            dragEnabled: false,
            closeOnOutsideClick: true
    };

    var showUpload = function(data,lampiran) {
        id = data;
        if(lampiran !== null) {
            
            title = lampiran;
        } else {
            title = "belum ada lampiran";
        }

        console.log(id);

        if(popup) {
            popup.option("contentTemplate", popupOptions.contentTemplate.bind(this));
        } else {
            popup = $("#popup").dxPopup(popupOptions).dxPopup("instance");
        }

        popup.show();
    };

    var showDisposisi = function(data,file) 
    {
        $.get('api/status-suratkeluar/'+data,function(item){
            if(item == 0) {
                $('#modal-disposisi').modal('show');
                $('#file_disposisi').val(file);
            } else {
                DevExpress.ui.notify("dalam status pengajuan, aksi tidak di izinkan", "error", 5000);
            }
        });
        $('#getid').val(data);
    };

    $('#btn-action').on("click",function(){
        console.log('button action');

        var datastring = $("#form-dism").serialize();
        $.ajax({
            type: "POST",
            url: "/api/send-disposisi",
            data: datastring,
            dataType: "json",
            success: function(data) {
                console.log(data);
                //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                // do what ever you want with the server response
                DevExpress.ui.notify(data.message, data.status, 2000);

            },
            error: function() {
                DevExpress.ui.notify(data.message, data.status, 5000);

                // alert('error handling here');
                // DevExpress.ui.notify("error", "error", 2000);

            }
        });
        $('#modal-disposisi').modal('hide');
        dataGrid.refresh();
    })
 
    queSifatSurat = [{id:1,value:"biasa"},{id:2,value:"segera"},{id:3,value:"penting"}];
    var disposisi = item;
        var dataGrid = $("#grid-suratkeluar").dxDataGrid({     
            dataSource: store,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnsAutoWidth: true,
            columnMinWidth: 80,
            wordWrapEnabled: true,
            showBorders: true,
            filterRow: { visible: true },
            filterPanel: { visible: true },
            headerFilter: { visible: true },
            selection: {
                mode: "multiple"
            },
            editing: {
                useIcons:true,
                mode: "popup",
                allowAdding: (role=="admin" || role == "user")?true:false,
                allowUpdating:  (role=="admin" || role == "user")?true:false,
                allowDeleting: false
            },
            scrolling: {
                mode: "infinite"
            },
            columns: [
                {
                    caption: '#',formItem: {visible:false},width:40,
                    cellTemplate:function(container,options) {
                        container.text(options.rowIndex +1);
                    }
                },
                {
                    caption: 'Tambah/Edit Berkas',
                    visible: (role=="admin" || role == "user")?true:false,
                    formItem: {visible:false},
                    editorOptions: {
                        disabled: true
                    },
                    cellTemplate: function(container, options) {
            
                        $('<button class="btn btn-danger btn-xs">Upload</button>').addClass('dx-button').on('dxclick', function(evt) {
                            evt.stopPropagation();
                            $.get('api/status-suratkeluar/'+options.data.id_surat_keluar,function(item){
                                if(item == 0) {
                                    showUpload(options.data.id_surat_keluar,options.data.file_surat_keluar);
                                } else {
                                    DevExpress.ui.notify("dalam status pengajuan, aksi tidak di izinkan", "error", 5000);
                                }
                            })
    
                        }).appendTo(container);
                        
                        }
                },
                { 
                    dataField: "no_surat",
                    width: 150,
                },{ 
                    dataField: "perihal_surat",
                    width: 150,
                },{ 
                    dataField: "tgl_dibuat",
                    width: 150,
                    sortIndex: 0, sortOrder: "desc",
                    dataType:"date", format:"dd-MM-yyyy"
                },{ 
                    dataField: "tujuan",
                    width: 150,
                },{ 
                    dataField: "agenda",
                    width: 150,
                },
                { 
                    dataField: "sifat_surat",
                    editorType: "dxSelectBox",
                    validationRules: [
                        { type: "required" }
                    ],
                    editorOptions: {
                        dataSource: queSifatSurat,  
                        valueExpr: 'value',
                        displayExpr: 'value',
                    },
                },   
                {
                    caption: 'Disposisi',
                    formItem: {visible:false},
                    visible: (role=="admin" || role == "user")?true:false,
                    editorOptions: {
                        disabled: true
                    },
                    fixed: true,
                    fixedPosition: "right",
                    cellTemplate: function(container, options) {
            
                    $('<button class="btn btn-info btn-xs">Disposisi</button>').addClass('dx-button').on('dxclick', function(evt) {
                        evt.stopPropagation();
                            showDisposisi(options.data.id_surat_keluar,options.data.file_surat_keluar);
                    }).appendTo(container);
                    
                    }
                },
                { 
                    dataField: "status",
                    formItem: {visible:false},
                    width: 150,
                    fixed: true,
                    fixedPosition: "right",
                    encodeHtml: false,
                    customizeText: function(e) {
                        var stext = ["<span class='mb-2 mr-2 badge badge-secondary'>Draft</span>","<span class='mb-2 mr-2 badge badge-primary'>Waiting Approval</span>","<span class='mb-2 mr-2 badge badge-success'>Approved</span>","<span class='mb-2 mr-2 badge badge-danger'>Rejected</span>",""];
                        return stext[e.value];
                    }

                },
                { 
                    dataField: "file_surat_keluar",
                    width: 150,
                    formItem: {visible:false},
                    fixed: true,
                    fixedPosition: "right",
                    editorOptions: {
                        disabled: true
                    },
                    cellTemplate: function(container, options) {
            
                        $('<a href="/upload/'+options.data.file_surat_keluar+'" target="_blank">'+options.data.file_surat_keluar+'</a>').addClass('dx-link').appendTo(container);
                        
                    }
                },
                
            ],
            export: {
                enabled: true,
                fileName: "surat-keluar",
                excelFilterEnabled: true,
                allowExportSelectedData: true
            },
            masterDetail: {
                enabled: true,
                template: function(container, options) { 
                    var currentEmployeeData = options.data;
    
                    // $("<div>")
                    //     .addClass("master-detail-caption")
                    //     .text(currentEmployeeData.FirstName + " " + currentEmployeeData.LastName + "'s Tasks:")
                    //     .appendTo(container);
    
                    $("<div>")
                        .dxDataGrid({
                            columnAutoWidth: true,
                            showBorders: true,
                            columns: [
                            {
                                dataField: "no_agenda",
                            }, {
                                dataField: "nama_karyawan",
                            }, { 
                                dataField: "tgl_disposisi",
                                dataType:"date", format:"dd-MM-yyyy",displayFormat: "dd-MM-yyyy",
                            }, {
                                dataField: "dengan_hormat_harap",
                            }, {
                                dataField: "catatan_tindak_lanjut",
                            }, { 
                                dataField: "status",
                                encodeHtml: false,
                                customizeText: function(e) {
                                    var stext = ["","<span class='mb-2 mr-2 badge badge-primary'>Waiting Approval</span>","<span class='mb-2 mr-2 badge badge-success'>Approved</span>","<span class='mb-2 mr-2 badge badge-danger'>Rejected</span>","<span class='mb-2 mr-2 badge badge-info'>Di Teruskan</span>",""];
                                    return stext[e.value];
                                }
            
                            }
                            ],
                            dataSource: new DevExpress.data.DataSource({
                                store: new DevExpress.data.ArrayStore({
                                    key: "id_surat_keluar",
                                    data: disposisi
                                }),
                                filter: ["id_surat_keluar", "=", options.key]
                            })
                        }).appendTo(container);
                }
            },
            onContentReady: function(e){
                moveEditColumnToLeft(e.component);
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
                },
                )
            },
            onSelectionChanged: function(data) {
                deleteButton.option("disabled", !data.selectedRowsData.length);
                // selectedItems = data.selectedRowsData;
                // disabled = !selectedItems.length;
            }, 
        }).dxDataGrid("instance");
  
    var deleteButton = $("#gridDeleteSelected").dxButton({
        text: "Delete Selected Records",
        height: 34,
        disabled: true,
        onClick: function () {
            var result = DevExpress.ui.dialog.confirm("Are you sure you want to delete selected?", "Delete row");
            result.done(function (dialogResult) {
                if (dialogResult){
                    $.each(dataGrid.getSelectedRowKeys(), function() {
                        store.remove(this);
                    });
                    dataGrid.refresh();
                }
            });
            
        }
    }).dxButton("instance");
})

});