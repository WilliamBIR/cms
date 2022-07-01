var GaplessPlayback = function(a, b) {
    function p(a) {
        switch (a.substr(-3).toLowerCase()) {
            case "mp4":
            case "mpg":
                return "video";
            default:
                throw "Archivo no soportado: " + a
        }
    }

    function q(a) {
        if ("video" === p(g[a].url))(new Storage).writeFile(function(b) {
            a++, a < g.length ? q(a) : (r(), s())
        }, function(a) {
            throw "Error al escribir el archivo de la lista de reproducción: [" + a.errorCode + "] " + a.errorText
        }, {
            data: l + g[a].url + "\n",
            path: "file://internal/unzip/" + b + ".txt",
            mode: 0 == a ? "truncate" : "append",
            encoding: "utf8"
        });
        else {
            if ("image" !== p(g[a].url)) throw "Tipo de contenido no válido: " + g[a];
            a++, a < g.length ? q(a) : (r(), s())
        }
    }

    function r() {
        var a = document.createElement("source");
        a.setAttribute("src", "File:////media/cryptofs/apps/usr/palm/applications/com.lg.app.signage/content/unzip/" + b + ".txt");
        var c = {};
        c.htmlMediaOption = {}, c.htmlMediaOption.useUMSMediaInfo = !0, a.setAttribute("type", "video/mp4;mediaOption=" + escape(JSON.stringify(c))), d.appendChild(a), d.load(), a = null, d.addEventListener("umsmediainfo", function(a) {
            try {
                var b = JSON.parse(a.detail);
                b && !("type" in b) || "error" === b.type, "EOF" === b.info.gapless.eventType ? "image" === g[j - 1].type && d.pause() : "pre_EOF" !== b.info.gapless.eventType && "EOP" !== b.info.gapless.eventType || s()
            } catch (a) {}
        }, !1), d.play(), "number" == typeof g[0].imgLoadTime && (n = g[0].imgLoadTime)
    }

    function s() {
    }

    function t() {
        j = j % i + 1;
        var a = g[j - 1];
        return a
    }
    var d, e, f, l, c = {
            FILL: "fill",
            CONTAIN: "contain"
        },
        g = [],
        i = 0,
        j = 0,
        k = 5,
        m = !1,
        n = 0;
    if ("string" != typeof a) throw "[GaplessPlayback] Parameter type is not string: " + a;
    if ("string" != typeof b) throw "[GaplessPlayback] Parameter type is not string: " + b;
    var o = document.getElementById(a);
    if (!o) throw "[GaplessPlayback] Cannot found div tag: " + a;
    d = document.createElement("VIDEO"), d.style.position = "absolute", d.style.top = d.style.left = "0px", d.style.width = d.style.height = "100%", d.style.padding = d.style.border = d.style.margin = "0px", d.loop = !0, d.texture = !0, o.appendChild(d), GaplessPlayback.prototype.getPlaylist = function() {
        return g
    }, GaplessPlayback.prototype.getCurrentContent = function() {
        if (j - 1 < 0 || j - 1 > g.length) throw "[GaplessPlayback.getCurrentContent] Out of range.";
        return g[j - 1]
    }, GaplessPlayback.prototype.addContent = function(a, b) {
        if ("string" != typeof a) throw "[GaplessPlayback.addContent] Parameter type is not string: " + a;
        if (g[i] = {}, g[i].url = a, g[i].type = p(a), "image" === g[i].type) {
            if (b < 0) throw "[GaplessPlayback.setImageDuration] Invalid parameter. Duration value must be positive value: " + b;
            g[i].imgDuration = b
        } else g[i].imgLoadTime = b;
        i++
    }, GaplessPlayback.prototype.deleteContent = function(a) {
        if ("string" != typeof a) throw "[GaplessPlayback.addContent] Parameter type is not string: " + a;
        for (var b = 0; b < i; b++)
            if (a === g[b].url) return g.splice(b, 1), i--, !0;
        throw "[GaplessPlayback.deleteContent] Parameter is not valid: " + a
    }, GaplessPlayback.prototype.deleteAllPlaylist = function() {
        return g = [], i = 0, j = 0, !0
    }, GaplessPlayback.prototype.play = function() {
        q(0)
    }, GaplessPlayback.prototype.setObjectFit = function(a) {
        if ("string" != typeof a) throw "[GaplessPlayback.setObjectFit] Parameter type is not string: " + a;
        if (a === c.FILL) d.style["object-fit"] = c.FILL;
        else {
            if (a !== c.CONTAIN) throw "[GaplessPlayback.setObjectFit] Invalid parameter: " + a;
            d.style["object-fit"] = c.CONTAIN
        }
    }, GaplessPlayback.prototype.setImageDuration = function(a) {
        if ("number" != typeof a) throw "[GaplessPlayback.setImageDuration] Parameter type is not number: " + a;
        if (a < 0) throw "[GaplessPlayback.setImageDuration] Invalid parameter. Duration value must be positive value: " + a;
        k = a
    }, GaplessPlayback.prototype.setContentPath = function(a) {
        if ("string" != typeof a) throw "[GaplessPlayback.setContentPath] Parameter type is not string: " + mode;
        var b = {
            zip: "File:////mnt/lg/appstore/scap/procentric/scap/application/app/",
            ipk: "File:////media/cryptofs/apps/usr/palm/applications/com.lg.app.signage/content/unzip/",
            scap: "File:////mnt/lg/appstore/scap/contents/"
        };
        "zip" === a ? l = b.zip : "ipk" === a ? l = b.ipk : "scap" === a && (l = b.scap, m = !0)
    }
};