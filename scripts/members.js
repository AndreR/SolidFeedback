function Members(elementId) {
	var loaded = false;
	var selectElement = null;

	function addEventListener(target, type, listener) {
		if(target.addEventListener) {
			target.addEventListener(type, listener, false);
		}
		else if(target.attachEvent) {
			target.attachEvent("on" + type, listener);
		}
	}

	function createElement(qualifiedName) {
		if(document.documentElement.tagName == "HTML") {
			return document.createElement(qualifiedName);   
		}

		return document.createElementNS("http://www.w3.org/1999/xhtml", qualifiedName);
	}

	function onchange(evt) {
		var name = encodeURIComponent(selectElement.value);
		document.getElementById("picture").src = "images/members/" + name + ".jpg";
		document.getElementById("permalink").href = "?to=" + name.replace("%20", "+");
	}

	function onload(evt) {
		if(loaded) return;
		loaded = true;

		selectElement = document.getElementById(elementId);
		if(!selectElement) return;

		addEventListener(selectElement, "change", onchange);

		onchange(null);
	}

	addEventListener(document, "DOMContentLoaded", onload);
	addEventListener(window, "load", onload);
}

var members = null;

if(document.getElementById && (window.addEventListener || window.attachEvent) && typeof encodeURIComponent != "undefined") {
	members = new Members("members");
}
