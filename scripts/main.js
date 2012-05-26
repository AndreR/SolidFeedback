function SolidFeedback() {
	var loaded = false;
	var selectElement = null;
	var permalinkElement = null;
	var pictureElement = null;

	function W3CDOM_Event(currentTarget) {
		this.currentTarget = currentTarget;
		this.preventDefault = function() { window.event.returnValue = false; };

		return this;
	}

	function addEventListener(target, type, listener) {
		if(target.addEventListener) {
			target.addEventListener(type, listener, false);
		}
		else if(target.attachEvent) {
			target.attachEvent("on" + type, function() { listener(new W3CDOM_Event(target)); } );
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

	function onclick(evt) {
		evt.preventDefault();
		window.history.back();
	}

	function onload(evt) {
		if(loaded) return;
		loaded = true;

		selectElement = document.getElementById("concerned_person");
		if(selectElement) {
			var parentElement = selectElement.parentNode;
			if(parentElement) {
				parentElement.appendChild(document.createTextNode(" "));

				permalinkElement = createElement("a");
				permalinkElement.setAttribute("class", "permalink");
				permalinkElement.setAttribute("rel", "bookmark");
				permalinkElement.setAttribute("title", "Du kannst diesen Link weitergeben, um direkt auf die ausgewählte Person zu verweisen.");
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
		}

		var aElement = document.getElementById("backlink");
		if(aElement) {
			addEventListener(aElement, "DOMActivate", onclick);
			addEventListener(aElement, "click", onclick);
		}
	}

	addEventListener(document, "DOMContentLoaded", onload);
	addEventListener(window, "load", onload);
}

var solidFeedback = null;

if(document.getElementById && (window.addEventListener || window.attachEvent) && typeof encodeURIComponent != "undefined") {
	solidFeedback = new SolidFeedback();
}
