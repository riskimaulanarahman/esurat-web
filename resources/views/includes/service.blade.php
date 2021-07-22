<script>
    // Riski Maulana Rahman
    apiurl = window.location.origin+'/api';
    function sendRequest(url, method, data) {
        var d = $.Deferred();
    
        method = method || "GET";
    
    
        $.ajax(url, 
        {
            method: method || "GET",
            data: data,
            headers: {"Accept": "application/json"},
            cache: false,
            xhrFields: { withCredentials: true }
        }).done(function(result) {
            d.resolve(method === "GET" ? result.data : result);
    
            var type = (result.status == "success" ? "success" : "error"),
            text = result.message;
            time = (result.status == "success" ? 2000 : 5000)
    
            // if(method !== "GET" && result.status == "success") {
            //     logSuccess(username, method, url, data);
            // } else if(method !== "GET" && result.status == "error") {
            //     logError(username, method, url, text);
            // }
            console.log(result.data);
            if(result.status !== "show") {

                DevExpress.ui.notify(text, type, time);
            }
        }).fail(function(xhr) {
            console.log('failed');
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });
    
        return d.promise();
    }

    function sendRequestdis(url, method, data) {
        var d = $.Deferred();    
    
        $.ajax(url, 
        {
            method: method,
            data: {"module":"suratmasuk","data":data},
            headers: {"Accept": "application/json"},
            cache: false,
            xhrFields: { withCredentials: true }
        }).done(function(result) {
            d.resolve(method === "GET" ? result.data : result);
    
            var type = (result.status == "success" ? "success" : "error"),
            text = result.message;
            time = (result.status == "success" ? 2000 : 5000)
    
            console.log(result.data);
            if(result.status !== "show") {

                DevExpress.ui.notify(text, type, time);
            }
        }).fail(function(xhr) {
            console.log('failed');
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });
    
        return d.promise();
    }

    function sendRequestdisk(url, method, data) {
        var d = $.Deferred();    
    
        $.ajax(url, 
        {
            method: method,
            data: {"module":"suratkeluar","data":data},
            headers: {"Accept": "application/json"},
            cache: false,
            xhrFields: { withCredentials: true }
        }).done(function(result) {
            d.resolve(method === "GET" ? result.data : result);
    
            var type = (result.status == "success" ? "success" : "error"),
            text = result.message;
            time = (result.status == "success" ? 2000 : 5000)
    
            console.log(result.data);
            if(result.status !== "show") {

                DevExpress.ui.notify(text, type, time);
            }
        }).fail(function(xhr) {
            console.log('failed');
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });
    
        return d.promise();
    }

    function filter(sce) {
        $.filter('html', function(sce) {
            return function(val) {
                return sce.trustAsHtml(val);
            };
        });
    }
        
    //get list
    listJabatan = {
        store: new DevExpress.data.CustomStore({
            key: "id_jabatan",
            loadMode: "raw",
            load: function() {
                return $.post(apiurl + "/list-jabatan");
            }
        }),
        sort: "nama_jabatan"
    }
    
    listKecamatan = {
        store: new DevExpress.data.CustomStore({
            key: "id_kecamatan",
            loadMode: "raw",
            load: function() {
                return $.post(apiurl + "/list/zona-kecamatan");
            }
        }),
        sort: "nama_kecamatann"
    }
    
    listKelurahan = {
        store: new DevExpress.data.CustomStore({
            key: "id_kelurahan",
            loadMode: "raw",
            load: function() {
                return $.post(apiurl + "/list/zona-kelurahan");
            }
        }),
        sort: "nama_kelurahan"
    }
    
    listLevelUser = {
        store: new DevExpress.data.CustomStore({
            key: "id_level",
            loadMode: "raw",
            load: function() {
                return $.post(apiurl + "/list/level-user");
            }
        }),
        sort: "jenis_level_user"
    }
    
    listStatusUser = {
        store: new DevExpress.data.CustomStore({
            key: "id_status",
            loadMode: "raw",
            load: function() {
                return $.post(apiurl + "/list/status-user");
            }
        }),
        sort: "status_pengguna"
    }
    
    
    //log
    function logSuccess(username, method, url, data, token) {
        var d = $.Deferred();
    
        // console.log(method);
        // console.log(url);
        // console.log(data);
    
        var logUrl = window.location.origin+'/api';
    
        $.ajax(logUrl+"/logsuccess", 
        {
            method: "POST",
            data: {user:username,url:url,action:method,values:JSON.stringify(data)},
            headers: {"Accept": "application/json","Authorization" : "Bearer "+token},
            cache: false,
        });
    
        return d.promise();
    
    }
    
    function logError(username, method, url, text, token) {
        var d = $.Deferred();
    
        var logUrl = window.location.origin+'/api';
    
        $.ajax(logUrl+"/logerror", 
        {
            method: "POST",
            data: {user:username,url:url,action:method,values:JSON.stringify(text)},
            headers: {"Accept": "application/json","Authorization" : "Bearer "+token},
            cache: false,
        });
    
        return d.promise();
    
    }
    </script>