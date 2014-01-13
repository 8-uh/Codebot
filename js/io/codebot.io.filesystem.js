/*
Copyright 2012 Google Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Author: Eric Bidelman (ericbidelman@chromium.org)
Updated: Joe Marini (joemarini@google.com)
Adaptation: Fernando Bevilacqua (dovyski@gmail.com)
*/

var CodebotFS = new function() {
	this.driver = 'cc.codebot.io.FileSystem';
    
    var errorHandler = function(e) {
        console.error(e);
    };
    
    var displayEntryData = function(theEntry) {
        if (theEntry.isFile) {
            chrome.fileSystem.getDisplayPath(theEntry, function(path) {
                CODEBOT.ui.log('short: ' + path);
            });
            theEntry.getMetadata(function(data) {
                CODEBOT.ui.log('Size: ' + data.size);
            });    
        } else {
            CODEBOT.ui.log('full: ' + theEntry.fullPath);
        }
    };
	
    var loadDirEntry = function(theEntry, theParent, theCalls, theCallback) {
        var chosenEntry = theEntry;
        
        if (chosenEntry.isDirectory && chosenEntry.name.charAt(0) != '.') {
            var dirReader = chosenEntry.createReader();
            var entries = [];
    
            // Call the reader.readEntries() until no more results are returned.
            var readEntries = function() {
                dirReader.readEntries (function(results) {
                    CODEBOT.ui.log('dirReader');
                    if (!results.length) {
                        //CODEBOT.ui.log(entries.join('<br />'));
                        //saveFileButton.disabled = true; // don't allow saving of the list
                        displayEntryData(chosenEntry);
                        //CODEBOT.ui.log('Done reading!');
                        if(theParent) {
                            theParent.children = entries;
                        }
                        console.log('folder ('+theCalls+'):' + theParent.name, entries);
                        //theCallback(entries);
                    } else {
                        results.forEach(function(item) { 
                            CODEBOT.ui.log('Item: ' + item.name + ' | ' + item.fullPath);
                            
                            var aNode = null;
                            
                            if(item.isDirectory) {
                                aNode = {
                                    title: item.name,
                                    folder: true,
                                    key: item.name,
                                    children: [],
                                    path: item.fullPath,
                                    name: item.name
                                };
                                
                                loadDirEntry(item, aNode, theCalls + 1, theCallback);
                            } else {
                                aNode = {
                                    title: item.name,
                                    path: item.fullPath,
                                    name: item.name
                                };
                            }
                            
                            entries = entries.concat(aNode);
                        });
                        readEntries();
                    }
                }, errorHandler);
            };
    
            readEntries(); // Start reading dirs.
        }
    }
    
	this.init = function() {
	};
	
	this.openDirectory = function(thePath, theCallback) {
        chrome.fileSystem.chooseEntry({type: 'openDirectory'}, function(thePath) {
            if (!thePath) {
                console.error('No Directory selected.');
                return;
            }
            // use local storage to retain access to this file
            chrome.storage.local.set({'chosenFile': chrome.fileSystem.retainEntry(thePath)});
            CODEBOT.ui.log('path = ' + thePath.fullPath);
            
            var aNode = {
                title: '/root',
                folder: true,
                key: '/root',
                children: [],
                path: '/root',
                name: '/root'
            };
            
            loadDirEntry(thePath, aNode, 0, theCallback);
        });
        
        return;
        
		if(theCallback) {
			console.log('CodebotFS.openDirectory(' + thePath + ')');
			
			var aStructure = [
				{title: "Test.as", path: "/proj/folder/Test.as", name: "Test.as"},
				{title: "Folder 2", folder: true, key: "folder2",
				  children: [
					{title: "Test2.as", path: "/proj/folder/Test2.as", name: "Test2.as"},
					{title: "Test3.as", path: "/proj/folder/Test3.as", name: "Test3.as"}
				  ]
				},
				{title: "Test4.as", path: "/proj/folder/Test4.as", name: "Test4.as"}
			];
			
			theCallback(aStructure);
		}
	};
	
	this.openFile = function(thePath, theCallback) {
		if(theCallback) {
			console.log('CodebotFS.openFile(' + thePath + ')');
			theCallback('data found in ' + thePath);
		}
	};
	
	this.writeFile = function(thePath, theData, theCallback) {
		console.log('CodebotFS.writeFile(' + thePath + ')');
	};
	
	this.createDirectory = function(thePath, theCallback) {
		console.log('CodebotFS.createDirectory(' + thePath + ')');
	};
};

CODEBOT.io = CodebotFS;