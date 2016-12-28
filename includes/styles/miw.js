/*****************************************************************************************************************/
/*                                                                                                               */
/*                                Bibliothèque  MIW   version miw V  16 11 2016.js                                */
/*                                Réalisée dans le cadre des cours Javascript                                    */
/*                                De la Licence Activités et Techniques de Communication                         */
/*                                Mention Multimédia Internet Webmaster   (MIW)                                  */
/*                                IUT d'Aix-en-Provence Département GEA GAP                                      */
/*                                Site internet de la licence :     www.gap.univ-mrs.fr/miw                      */
/*                                                                                                               */
/*****************************************************************************************************************/

(function() { // ief  ou fie fonction immédiatement exécutée.

    /******************************************************************************************************/
    /***********************  Les expressions régulières    ***********************************************/
    /******************************************************************************************************/
    Reg = { // objet contenant des expressions régulières
        required: /[^.*]/,
        alpha: /^[a-z ._-]+$/i,
        alphanum: /^[a-z0-9 ._-]+$/i,
        digitSign: /^[-+]?[0-9]+$/,
        digit: /^[0-9]+$/,
        nodigit: /^[^0-9]+$/,
        number: /^[-+]?\d*\.?\d+$/,
        email: /^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i,
        phone: /^[\d\s().-]+$/,
        url: /^(http|https):\/\/[a-z0-9\-\.\/_]+\.[a-z]{2,3}$/i,
        tag: /<[^<>]+>/g, // pour rechercher toutes les occurences d'une balise HTML ou XML
        script: /(<script).+(<\/script>)/gi, // pour rechercher toutes les occurences de script

    };


    /******************************************************************************************************/
    /***********************  Les Raccourcis   pour le DOM  ***********************************************/
    /******************************************************************************************************/
    /* recherche de noeuds */
    _id = function(id) { return document.getElementById(id); };
    _tn = function(tn) { return document.getElementsByTagName(tn); };
    _n = function(n) { return document.getElementsByName(n); };
    /* Création d'un fragment */
    _cf = function() { return document.createDocumentFragment(); };
    /* Ajout élément el au noeuf NodeIns */
    _ce = function(el, nodeIns = null) {
        var tmpElement = document.createElement(el);
        if (nodeIns != null) {
            nodeIns.appendChild(tmpElement);
        }
        return tmpElement;
    };
    /* Ajout élément texte au noeud NodeIns */
    _ct = function(tx, nodeIns = null) {
        var tmpElement = document.createTextNode(tx);
        if (nodeIns != null) {
            nodeIns.appendChild(tmpElement);
        }
        return tmpElement;
    };
    /* Ajout d'élément au noeud NodeIns avec les attributs & styles */
    _cn = function(node, attribut, style, nodeIns = null) {
            var tmpNode = document.createElement(node);
            tmpNode.attrib(attribut);
            tmpNode.css(style);
            if (nodeIns != null) {
                nodeIns.appendChild(tmpNode);
            }
            return tmpNode;
        }
        /* Supprime le noeud */
    _dn = function(node) {
        var parent = node.parentNode;
        parent.removeChild(node);
    }


    /* Largeur de fenêtre selon navigateur */
    windowWidth = function() {
        if (window.innerWidth) {
            return window.innerWidth;
        } else if (document.documentElement.clientWidth) {
            return document.documentElement.clientWidth;
        } else if (document.body.clientWidth) {
            return document.body.clientWidth;
        } else {
            return -1;
        }
    };
    /* Hauteur de fenêtre selon navigateur */
    windowHeight = function() {
        if (window.innerHeight) {
            return window.innerHeight;
        } else if (document.documentElement.clientHeight) {
            return document.documentElement.clientHeight;
        } else if (document.body.clientHeight) {
            return document.body.clientHeight;
        } else {
            return -1;
        }
    };



    /******************************************************************************************************/
    /***********************  Extension de toutes les classes avec la methode extend  *********************/
    /******************************************************************************************************/
    String.prototype.extend = function(obj) {
        for (var i in obj) { this[i] = obj[i] };
    };
    Array.prototype.extend = function(obj) {
        for (var i in obj) { this[i] = obj[i] };
    };
    Number.prototype.extend = function(obj) {
        for (var i in obj) { this[i] = obj[i] };
    };
    Node.prototype.extend = function(obj) {
        for (var i in obj) { this[i] = obj[i] };
    };

    /******************************************************************************************************/
    /***********************  Extension de la clase String  ***********************************************/
    /******************************************************************************************************/
    String.prototype.extend({
        left: function(n) { return this.substring(0, n) },
        right: function(n) { return this.substring(this.length - n) },
        convertCss: function() {
            var ch = this,
                reg1 = /-[a-z]/gi,
                reg2 = /-/g;
            if (ch.match(reg1)) {
                for (var i = 0; i < ch.match(reg1).length; i++) {
                    ch = ch.replace(ch.match(reg1)[i], ch.match(reg1)[i].toUpperCase())
                }
                ch = ch.replace(reg2, "")
            }
            return ch;
        },
        capitalize: function() {
            return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
        },
        trim: function() {
            return this.replace(/(^\s*|\s*$)/g, "")
        }
    });
    /******************************************************************************************************/
    /***********************  Extension de la clase Array   ***********************************************/
    /******************************************************************************************************/

    Array.prototype.extend({
        merge: function(t) {
            for (var i = 0; i < t.length; i++) {
                this.push(t[i]);
            }
            return this
        }
    });
    /******************************************************************************************************/
    /***********************  Extension de la clase Number  ***********************************************/
    /******************************************************************************************************/
    Number.prototype.extend({
        p: function(n) { return Math.pow(this, n) }
    });
    /******************************************************************************************************/
    /***********************  Extension de la clase Node    ***********************************************/
    /******************************************************************************************************/
    Node.prototype.extend({
        changeId: function(val) {
            this.id = val;
            return this;
        },
        css: function(obj) {
            for (var i in obj) {
                this.style[i.convertCss()] = obj[i];
            };
            return this;
        },
        attrib: function(obj) {
            for (var i in obj) {
                this.setAttribute(i, obj[i]);
            }
        },
        show: function() {
            this.style.display = "block";
        },
        hide: function() {
            this.style.display = "none";
        }
    });


})();