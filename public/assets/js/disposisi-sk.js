$(document).ready(function(){
    role = $('.roleuser').val();
    nikuser = $('.nikuser').val();
    
    
    var store = new DevExpress.data.CustomStore({
        key: "id_disposisi",
        load: function() {
            return sendRequest(apiurl + "/disposisi-api?module=suratkeluar&nik="+nikuser);
        },
        insert: function(values) {
            return sendRequest(apiurl + "/disposisi-api/", "POST", values);
        },
        update: function(key, values) {
            return sendRequestdisk(apiurl + "/disposisi-api/"+key, "PUT", values);
        },
        remove: function(key) {
            return sendRequest(apiurl + "/surat-masuk/"+key, "DELETE");
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

    var showDisposisi = function(data) 
    {

        console.log(data);
        $.get('api/status-disposisi/'+data,function(item){
            if(item == 0) {
                $('#modal-disposisi').modal('show');
            } else {
                DevExpress.ui.notify("aksi tidak di izinkan", "error", 5000);
            }
        });
        $('#getid').val(data);
    };

    $('#btn-action').on("click",function(){
        console.log('button action');

        var datastring = $("#form-dism").serialize();
        $.ajax({
            type: "POST",
            url: "/api/aksi-disposisi",
            data: datastring,
            dataType: "json",
            success: function(data) {
                console.log(data);
                DevExpress.ui.notify(data.message, data.status, 2000);
            },
            error: function() {
                DevExpress.ui.notify(data.message, data.status, 5000);
            }
        });
        $('#modal-disposisi').modal('hide');
        dataGrid.refresh();
    })

    
    OptHormat = [{id:1,option:"Tanggapan dan Saran"},{id:2,option:"Proses Lebih Lanjut"},{id:3,option:"Koordinasi / Konfirmasi"},{id:4,option:"Lainnya"}];
    queSifatSurat = [{id:1,value:"biasa"},{id:2,value:"segera"},{id:3,value:"penting"}];

        var dataGrid = $("#grid-dsuratkeluar").dxDataGrid({     
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
            // selection: {
            //     mode: "multiple"
            // },
            columnFixing: { 
                enabled: true
            },
            editing: {
                useIcons:true,
                mode: "popup",
                allowAdding: false,
                
                allowUpdating: true,
                allowDeleting: false
            },
            scrolling: {
                mode: "infinite"
            },
            columns: [
                {
                    caption: '#',formItem: {visible:false},fixed: true,width:40,
                    cellTemplate:function(container,options) {
                        container.text(options.rowIndex +1);
                    }
                },
                // { 
                //     caption: "asal surat",
                //     dataField: "suratkeluar.asal_surat",
                //     width: 150,
                //     editorOptions: {
                //         disabled: true
                //     },
                // },
                { 
                    caption: "perihal",
                    dataField: "suratkeluar.perihal_surat",
                    width: 150,
                    editorOptions: {
                        disabled: true
                    },
                },
                { 
                    caption: "tgl surat",
                    dataField: "suratkeluar.tgl_dibuat",
                    width: 150,
                    editorOptions: {
                        disabled: true
                    },
                },
                { 
                    caption: "no surat",
                    width: 300,
                    dataField: "suratkeluar.no_surat",
                    editorOptions: {
                        disabled: true
                    },
                },
                { 
                    caption: "no agenda",
                    dataField: "no_agenda",
                    width: 150,
                    editorOptions: {
                        disabled: true
                    },
                },
                { 
                    caption: "sifat surat",
                    dataField: "suratkeluar.sifat_surat",
                    width: 150,
                    editorOptions: {
                        disabled: true
                    },
                },
                { 
                    dataField: "dengan_hormat_harap",
                    editorType: "dxSelectBox",
                    validationRules: [
                        { type: "required" }
                    ],
                    editorOptions: {
                        dataSource: OptHormat,  
                        valueExpr: 'option',
                        displayExpr: 'option',
                    },
                },
                { 
                    dataField: "catatan_tindak_lanjut",
                    width: 150,
                    editorType: "dxTextArea",
                    height: 90,
                },
                
                { 
                    dataField: "status",
                    formItem: {visible:false},
                    width: 150,
                    fixed: true,
                    fixedPosition: "right",
                    encodeHtml: false,
                    customizeText: function(e) {
                        var stext = ["","<span class='mb-2 mr-2 badge badge-primary'>Waiting Approval</span>","<span class='mb-2 mr-2 badge badge-success'>Approved</span>","<span class='mb-2 mr-2 badge badge-danger'>Rejected</span>","<span class='mb-2 mr-2 badge badge-info'>Di Teruskan</span>",""];
                        return stext[e.value];
                    }

                },
                { 
                    caption: "file lampiran",
                    dataField: "file_disposisi",
                    width: 150,
                    formItem: {visible:false},
                    fixed: true,
                    fixedPosition: "right",
                    editorOptions: {
                        disabled: true
                    },
                    cellTemplate: function(container, options) {
            
                        $('<a href="/upload/'+options.data.file_disposisi+'" target="_blank">'+options.data.file_disposisi+'</a>').addClass('dx-link').appendTo(container);
                        
                    }
                },
                {
                    caption: 'Aksi',
                    formItem: {visible:false},
                    visible: (role=="admin" || role == "user")?true:false,
                    editorOptions: {
                        disabled: true
                    },
                    fixed: true,
                    fixedPosition: "right",
                    cellTemplate: function(container, options) {
            
                    $('<button class="btn btn-info btn-xs">Show</button>').addClass('dx-button').on('dxclick', function(evt) {
                        evt.stopPropagation();
                            showDisposisi(options.data.id_disposisi);
                    }).appendTo(container);
                    
                    }
                },
                
            ],
            export: {
                enabled: false,
                fileName: "surat-masuk",
                excelFilterEnabled: true,
                allowExportSelectedData: true
            },
            onContentReady: function(e){
                moveEditColumnToLeft(e.component);
            },
            // onEditorPreparing: function(e) {
            //     // console.log(e.row);  
            //     if(e.dataField == "file_surat_masuk") {
            //         e.editorName = "dxFileUploader";
            //         e.editorOptions.uploadMode = "useButtons";
            //         e.editorOptions.name = "myFile";
            //         e.editorOptions.accept = "image/*,application/pdf";
            //         // e.edtorOptions.uploadUrl = "/api/";
            //     }
            // },
            onToolbarPreparing: function(e) {
        
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


});
