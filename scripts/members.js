function Members(elementId) {
	var loaded = false;
	var selectElement = null;
	var permalinkElement = null;
	var pictureElement = null;

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
		permalinkElement.setAttribute("href", "?to=" + name.replace("%20", "+"));
		pictureElement.setAttribute("src", "images/members/" + name + ".jpg");
	}

	function onload(evt) {
		if(loaded) return;
		loaded = true;

		selectElement = document.getElementById(elementId);
		if(!selectElement) return;

		var parentElement = selectElement.parentNode;
		if(!parentElement) return;

		parentElement.appendChild(document.createTextNode(" "));

		permalinkElement = createElement("a");
		permalinkElement.setAttribute("class", "permalink");
		permalinkElement.setAttribute("rel", "bookmark");
		permalinkElement.setAttribute("title", "Du kannst diesen Link weitergeben, um direkt auf die ausgewählte Person zu verweisen.");
		permalinkElement.setAttribute("tabindex", "20");
		permalinkElement.appendChild(document.createTextNode("Permanentlink"));
		parentElement.appendChild(permalinkElement);

		parentElement.appendChild(createElement("br"));

		var outerElement = createElement("span");
		outerElement.setAttribute("class", "picture_frame");
		var innerElement = createElement("span");
		innerElement.setAttribute("class", "picture");
		pictureElement = createElement("img");
		pictureElement.setAttribute("alt", "");
		innerElement.appendChild(pictureElement);
		outerElement.appendChild(innerElement);
		parentElement.appendChild(outerElement);

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
