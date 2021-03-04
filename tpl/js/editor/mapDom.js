function mapDOM(element, json) {
	var treeObject = {};
	parser = new DOMParser();
	docNode = parser.parseFromString(element, "text/xml");

	function toTree(element, objectJson, root) {
		(root) ? (objectJson["time"] = 5852748512960) : {};
		var nodeList = element.childNodes;
		if (nodeList != null) {
			if (nodeList.length) {
				objectJson["blocks"] = [];
				for (var i = 0; i < nodeList.length; i++) {
					if (nodeList[i].nodeType == 1) {
						if (nodeList[i].tagName == "p") {
							objectJson.blocks[objectJson.blocks.length] = {
								"type": "paragraph",
								"data": {
									"text": nodeList[i].innerHTML
								}
							}
							objectJson["blocks"].push({});
						}
						else if (nodeList[i].tagName == "div") {
							objectJson.blocks[objectJson.blocks.length] = {
								"type": "paragraph",
								"data": {
									"text": nodeList[i].innerHTML
								}
							}
						}
						else {
							objectJson.blocks[objectJson.blocks.length] = {
								"type": "paragraph",
								"data": {
									"text": nodeList[i].innerHTML
								}
							}
						}
					} else {
						if (nodeList[i].nodeType == 3) {
							objectJson.blocks[objectJson.blocks.length] = {
								"type": "paragraph",
								"data": {
									"text": nodeList[i].innerHTML
								}
							}
						} else {
							treeJson(nodeList[i], objectJson["blocks"][objectJson.blocks.length], false);
						}
					}
				}
			}
			if (element.attributes != null) {
				if (element.attributes.length) {
					object["attributes"] = {};
					for (var i = 0; i < element.attributes.length; i++) {
						object["attributes"][element.attributes[i].nodeName] = element.attributes[i].nodeValue;
					}
				}
			}
		}

	}
	toTree(docNode, treeObject, true);
	treeObject["version"] = "2.19.1";
	return (json) ? JSON.stringify(treeObject) : treeObject;
}
