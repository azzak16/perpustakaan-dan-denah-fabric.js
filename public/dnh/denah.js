// create a wrapper around native canvas element (with id="c")
var canvas = new fabric.Canvas('coba', {
  preserveObjectStacking: true
});

var padding = 3;

const gridOptions = {
  distance: 10,
  width: canvas.width,
  height: canvas.height,
  param: {
    stroke: '#ebebeb',
    strokeWidth: 1,
    selectable: false,
    hoverCursor: 'default'
  }
}
const gridLen = gridOptions.width / gridOptions.distance

for (var i = 0; i < gridLen; i++) {
  const distance = i * gridOptions.distance
  const horizontal = new fabric.Line([distance, 0, distance, gridOptions.width], gridOptions.param)
  const vertical = new fabric.Line([0, distance, gridOptions.width, distance], gridOptions.param)
  canvas.add(horizontal);
  canvas.add(vertical);
  if (i % 5 === 0) {
    horizontal.set({
      stroke: '#cccccc'
    })
    vertical.set({
      stroke: '#cccccc'
    })
  }
}

canvas.on('object:moving', function (e) {
  var obj = e.target;

  // if object is too big ignore
  if (obj.currentHeight > obj.canvas.height - padding * 2 ||
    obj.currentWidth > obj.canvas.width - padding * 2) {
    return;
  }
  obj.setCoords();

  // top-left corner
  if (obj.getBoundingRect().top < padding ||
    obj.getBoundingRect().left < padding) {
    obj.top = Math.max(obj.top, obj.top - obj.getBoundingRect().top + padding);
    obj.left = Math.max(obj.left, obj.left - obj.getBoundingRect().left + padding);
  }

  // bot-right corner
  if (obj.getBoundingRect().top + obj.getBoundingRect().height > obj.canvas.height - padding ||
    obj.getBoundingRect().left + obj.getBoundingRect().width > obj.canvas.width - padding) {
    obj.top = Math.min(
      obj.top,
      obj.canvas.height - obj.getBoundingRect().height + obj.top - obj.getBoundingRect().top - padding);
    obj.left = Math.min(
      obj.left,
      obj.canvas.width - obj.getBoundingRect().width + obj.left - obj.getBoundingRect().left - padding);
  }
});


function changeCanvasProperty(selValue, drawingVal) {
  canvas.selection = selValue;
  canvas.isDrawingMode = drawingVal;
}

function changeSelectableStatus(val) {
  canvas.forEachObject(function (obj) {
    obj.selectable = val;
  })
  canvas.renderAll();
}

function removeCanvasEvents() {
  canvas.off('mouse:down');
  canvas.off('mouse:move');
  canvas.off('mouse:up');
  canvas.off('object:moving');
}

var drawingModeEl = document.getElementById('drawing-mode');

drawingModeEl.onclick = drawingModeElFunc;

function drawingModeElFunc() {
  var val = canvas.isDrawingMode;
  val = !val;
  changeCanvasProperty(false, val);
  removeCanvasEvents();
  if (val) {
    drawingModeEl.innerHTML = 'Turn Off Free Draw';
  } else {
    drawingModeEl.innerHTML = 'Turn On Free Draw';
  }
};

var drawingLine = document.getElementById('line');
drawingLine.onclick = drawingLineFunc;

var lineOn = false;
var line;

function drawingLineFunc() {
  removeCanvasEvents();
  if (!lineOn) {
    drawingLine.innerHTML = 'Keluar';
    $('#line').removeClass('btn-default').addClass('btn-danger');
    lineOn = true;
    changeSelectableStatus(false);
    changeCanvasProperty(false, false);
    canvas.isDrawingMode = false;
    line = new Line(canvas);

  } else if (lineOn) {
    drawingLine.innerHTML = 'Gambar Line';
    $('#line').removeClass('btn-danger').addClass('btn-default');
    lineOn = false;
    changeSelectableStatus(true);
  }
};

// Draw Line
var Line = (function () {
  function Line(canvas) {
    this.canvas = canvas;
    this.isDrawing = false;
    this.bindEvents();
  }

  Line.prototype.bindEvents = function () {
    var inst = this;
    inst.canvas.on('mouse:down', function (o) {
      inst.onMouseDown(o);
    });
    inst.canvas.on('mouse:move', function (o) {
      inst.onMouseMove(o);
    });
    inst.canvas.on('mouse:up', function (o) {
      inst.onMouseUp(o);
    });
    inst.canvas.on('object:moving', function (o) {
      inst.disable();
    })
  }

  Line.prototype.onMouseUp = function (o) {
    var inst = this;
    if (inst.isEnable()) {
      inst.disable();
    }
  };

  Line.prototype.onMouseMove = function (o) {
    var inst = this;
    if (!inst.isEnable()) {
      return;
    }

    var pointer = inst.canvas.getPointer(o.e);
    var activeObj = inst.canvas.getActiveObject();

    activeObj.set({
      x2: pointer.x,
      y2: pointer.y
    });
    activeObj.setCoords();
    inst.canvas.renderAll();
  };

  Line.prototype.onMouseDown = function (o, coords) {
    var inst = this;
    inst.enable();

    var pointer = inst.canvas.getPointer(o.e);
    origX = pointer.x;
    origY = pointer.y;

    var points = [pointer.x, pointer.y, pointer.x, pointer.y];
    var line = new fabric.Line(points, {
      strokeWidth: 5,
      stroke: 'black',
      fill: 'black',
      originX: 'center',
      originY: 'center',
      selectable: false,
      hasBorders: false,
      // hasControls: false,
    });
    line.setControlsVisibility({
      mt: false,
      mb: false,
      ml: false,
      mr: false,
      tr: false,
      tl: false,
      br: false,
      bl: false,
      mtr: true //the rotating point (defaut: true)
    });
    inst.canvas.add(line).setActiveObject(line);
  };

  Line.prototype.isEnable = function () {
    return this.isDrawing;
  }

  Line.prototype.enable = function () {
    this.isDrawing = true;
  }

  Line.prototype.disable = function () {
    this.isDrawing = false;
  }

  return Line;
}());


// create a rectangle object
// var rect = new fabric.Rect({
//   left: 100,
//   top: 100,
//   fill: 'red',
//   width: 100,
//   height: 100
// });

// "add" rectangle onto canvas
// canvas.add(rect);
// console.log(JSON.stringify(canvas));

// console.log('heloooo');

// window.onload = function () {

//   document.getElementById("page_simpan").style.display = 'none';
//   document.getElementById("div_load").style.display = 'none';
//   document.getElementById("div_new").style.display = 'none';

//   // document.getElementById("cancel_simpan").style.display = 'none';

// };

// form new
function neW() {
  $('#div_new').removeClass('hidden');
  $('#div_load').addClass('hidden');
  // document.getElementById("div_load").removeClass('hidden');
};

// form load
function ld() {
  $('#div_load').removeClass('hidden');
  $('#div_new').addClass('hidden');
  // document.getElementById("div_load").style.display = 'block';
  // document.getElementById("div_new").style.display = 'none';
};

// ubah object ke json
function rasterizeJSON() {
  var myJSON = JSON.stringify(canvas);
  $('#page_simpan').removeClass('hidden');
  // document.getElementById("cancel_simpan").style.display = 'block';
  //document.getElementById("SVGRasterizer").innerHTML = myJSON;
  $('#file').val(myJSON);
};

// batal simpan
function cancelSimpan() {
  $('#page_simpan').addClass('hidden');
  $('#file').val('');
  $('#name').val('');
};

// $("#canvas2json").click(function() {
//   var json = canvas.toJSON();
//   $("#myTextArea").text(JSON.stringify(json));
// });

// $("#pilih_file").on("change", function () {
//   var lama = $("#pilih_file option:selected").val();
//   $("#text").val(lama);
// });

// load data
// $("#load").click(function () {
//   // var id = $("#pilih_file").text();
//   canvas.loadFromJSON(
//     $("#json-console").val(),
//     canvas.renderAll.bind(canvas));
// });

// ambil data dari db
$('#pilih_file').change(function () {
  var file = $(this).val();
  // var nama = $(this).text();
  var txt = $(this).find('option:selected').text();
  // var obj = JSON.stringify(txt);
  // console.log(txt);
  $('#name_up').val(txt);
  if (file == null || file == 0) {
    // $('#page_update').removeClass('show_element');
    $('#json-console').val('');
  } else {
    // $('#page_update').addClass('show_element');
    $.ajax({
      url: "/load",
      method: "GET",
      data: {
        file: file,
        status: status,
      },
      success: function (load) {

        $('#json-console').val(load['file']);
        document.getElementById('json-console').select();
        $('#status').val(load['status']);
        // console.log(datanya['file']);
        // console.log(datanya['status']);
        canvas.loadFromJSON(
          $("#json-console").val(),
          canvas.renderAll.bind(canvas));

      }

    });

  }
});

// update data
function prosesUpdate() {
  var name = $('#name_up').val();
  var json = JSON.stringify(canvas);
  var data = $('#pilih_file').val();
  var status = $('#status').val();
  // var _token = "{{ csrf_token() }}";
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "/denah/up",
    method: "POST",
    data: {
      name: name,
      status: status,
      json: json,
      data: data
    },
    dataType: "text",
    success: function () {
      location.reload();
      alert("data berhasil diupdate");

    }

  });
  return false;

};

// delete data
function prosesDelete() {
  var data = $('#pilih_file').val();
  var token = $("meta[name='csrf-token']").attr("content");
  if (confirm("yakin?")) {

    $.ajax({
      url: "/denah/delete/" + data,
      type: "DELETE",
      data: {
        // _token: "{{ csrf_token() }}",
        data: data,
        _token: token,
      },
      success: function () {
        location.reload();
        alert("data berhasil dihapus");
      }
    });

  } else {
    return false;
  }
};

// console load
var consoleJSONValue = ('');

function getConsoleJSON() {
  return consoleJSONValue;
};

function setConsoleJSON(value) {
  consoleJSONValue = value;
};

function loadJSON() {
  _loadJSON(consoleJSONValue);
};

var _loadJSON = function (json) {
  canvas.loadFromJSON(json, function () {
    canvas.renderAll();
  });
};

function addKotak() {
  // var coord = getRandomLeftTop();
  canvas.add(new fabric.Rect({
    left: 100,
    top: 100,
    fill: 'red',
    width: 100,
    height: 100
  }));
};

fabric.util.addListener(window, 'keyup', function (options) {
  if (options.keyCode === 46) {
    var activeObjects = canvas.getActiveObjects();
    canvas.discardActiveObject()
    if (activeObjects.length) {
      canvas.remove.apply(canvas, activeObjects);
    }
  }
});

function addText() {
  canvas.add(new fabric.IText('TES', {
    left: 200,
    top: 200,
    fontFamily: 'Arial',
    fill: 'black',

  }));
};

function getSelected() {
  return canvas.getActiveObject();
};



$("#fill_color").change(function () {
  canvas.getActiveObject().set("fill", this.value);
  canvas.renderAll();
  // $("h1").css('background', $(this).val());
});

$("#stroke_color").change(function () {
  canvas.getActiveObject().set("stroke", this.value);
  canvas.renderAll();
});

$("#bg_color").change(function () {
  canvas.getActiveObject().set("backgroundColor", this.value);
  canvas.renderAll();
});

$("#opacity").change(function () {
  canvas.getActiveObject().set("opacity", parseInt(this.value, 10) / 100);
  canvas.renderAll();
});

$("#stroke_width").change(function () {
  canvas.getActiveObject().set("strokeWidth", parseInt(this.value, 10));
  canvas.renderAll();
});


function sendBackwards() {
  var activeObject = canvas.getActiveObject();
  if (activeObject) {
    canvas.sendBackwards(activeObject);
  }
};

function sendToBack() {
  var activeObject = canvas.getActiveObject();
  if (activeObject) {
    canvas.sendToBack(activeObject);
  }
};

function bringForward() {
  var activeObject = canvas.getActiveObject();
  if (activeObject) {
    canvas.bringForward(activeObject);
  }
};

function bringToFront() {
  var activeObject = canvas.getActiveObject();
  if (activeObject) {
    canvas.bringToFront(activeObject);
  }
};

canvas.on('object:selected', function (e) {
  if (e.target.type === 'i-text') {
    document.getElementById('textControls').hidden = false;
    canvas.renderAll();
  }
});

canvas.on('before:selection:cleared', function (e) {
  if (e.target.type === 'i-text') {
    document.getElementById('textControls').hidden = true;
  }
});


$("#font_family").change(function () {
  canvas.getActiveObject().set("fontFamily", this.value);
  canvas.renderAll();
});

$("#text_align").change(function () {
  canvas.getActiveObject().set("textAlign", this.value);
  canvas.renderAll();
});

$("#textBgColor").change(function () {
  canvas.getActiveObject().set("textBackgroundColor", this.value);
  canvas.renderAll();
});

$("#fontSize").change(function () {
  canvas.getActiveObject().set("fontSize", parseInt(this.value, 10));
  canvas.renderAll();
});

var underline = document.getElementById('btn-underline');
var bold = document.getElementById('btn-bold');
var italic = document.getElementById('btn-italic');

underline.addEventListener('click', function () {
  dtEditText('underline');
});

bold.addEventListener('click', function () {
  dtEditText('bold');
});

italic.addEventListener('click', function () {
  dtEditText('italic');
});

// Functions
function dtEditText(action) {
  var a = action;
  var o = canvas.getActiveObject();
  var t;

  // If object selected, what type?
  if (o) {
    t = o.get('type');
  }

  if (o && t === 'i-text') {
    switch (a) {
      case 'bold':
        var isBold = dtGetStyle(o, 'fontWeight') === 'bold';
        dtSetStyle(o, 'fontWeight', isBold ? '' : 'bold');
        break;

      case 'italic':
        var isItalic = dtGetStyle(o, 'fontStyle') === 'italic';
        dtSetStyle(o, 'fontStyle', isItalic ? '' : 'italic');
        break;

      case 'underline':
        var isUnderline = dtGetStyle(o, 'underline') || false;
        dtSetStyle(o, 'underline', isUnderline ? false : true);
        o.dirty = true;
        break;
        canvas.renderAll();
    }
  }
}

// Get the style
function dtGetStyle(object, styleName) {
  return object[styleName];
}

// Set the style
function dtSetStyle(object, styleName, value) {
  object.set(styleName, value);
  canvas.renderAll();
}


function addImage(imageName) {

  fabric.Image.fromURL('denahgmbr/' + imageName, function (image) {
    image.scale(0.25)
    image.set({
      left: 100,
      top: 100
      // width: 100,
      // height: 100
    })

    canvas.add(image);
  });
};

function addImage1() {
  addImage('table.png');
};

function addImage2() {
  addImage('meja2.png');
};

function addImage3() {
  addImage('meja3.png');
};

function addImage4() {
  addImage('meja4.png');
};

function addImage5() {
  addImage('meja5.png');
};

function addImage6() {
  addImage('jendela.png');
};

function addImage7() {
  addImage('pintu.png');
};

function addImage8() {
  addImage('kursi.png');
};

function addImage9() {
  addImage('closed.png');
};

// (function () {
//   var $ = function (id) {
//     return document.getElementById(id)
//   };

//   var canvas = this.__canvas = new fabric.Canvas('coba');
//   fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';

//   //buat grid
//   var grid = 50;
//   var cWidth = canvas.getWidth();

//   for (var i = 0; i < (cWidth / grid); i++) {
//     canvas.add(new fabric.Line([i * grid, 0, i * grid, cWidth], {
//       stroke: '#ccc',
//       selectable: false
//     }));
//     canvas.add(new fabric.Line([0, i * grid, cWidth, i * grid], {
//       stroke: '#ccc',
//       selectable: false
//     }));
//   }

//   var wall = $('addWall');

//   var addmore = $('add');
//   var removed = $('remove');
//   // var addgrid = $('CanvasGrid');
//   // var removegrid = $('RemoveGrid');



//   addmore.onclick = add;
//   removed.onclick = remove;
//   wall.onclick = addWall;
//   // addgrid.onclick = CanvasGrid;
//   // removegrid.onclick = RemoveGrid;


//   //buat tambah kotak
//   function add() {
//     var rect = new fabric.Rect({
//       top: 100,
//       left: 0,
//       width: 80,
//       height: 50,
//       fill: 'blue',
//       strokeWidth: 3,
//       stroke: 'black',
//     });
//     canvas.add(rect);
//   }

//   //buat remove object
//   function remove() {
//     canvas.remove(canvas.getActiveObject());
//   }

//   // remove grid
//   // function RemoveGrid() {
//   //   var objects = canvas.getObjects('line');
//   //   for (let i in objects) {
//   //     canvas.remove(objects[i]);
//   //   }
//   //   RenderCanvas();
//   // }

//   var moveHandler = function (evt) {
//     var movingObject = evt.target;
//     console.log(movingObject.get('left'), movingObject.get('top'));
//   };
//   canvas.on('object:moving', function (e) {
//     var pt = this.getPointer(e.e);
//     // document.getElementById('object').textContent = pt.x.toFixed(0) + '/' + pt.y.toFixed(0);
//     document.getElementById('object').value = 'X =' + pt.x.toFixed(0) + '/ Y=' + pt.y.toFixed(0);
//     // var txtinput = "<input type='text' name='xy' id='' value=" + xynya + "/>"

//     // console.log(xynya);
//     // alert(txtinput);
//   });
//   // canvas.on({
//   //   'object:moving': moveHandler,
//   // });



//   function addWall() {
//     function makeCircle(left, top, line1, line2, ) {
//       var c = new fabric.Circle({
//         left: left,
//         top: top,
//         strokeWidth: 5,
//         radius: 12,
//         fill: '#fff',
//         stroke: '#666'
//       });
//       c.hasControls = c.hasBorders = false;

//       c.line1 = line1;
//       c.line2 = line2;

//       return c;
//     }

//     function makeLine(coords) {
//       return new fabric.Line(coords, {
//         fill: 'red',
//         stroke: 'red',
//         strokeWidth: 5,
//         selectable: false,
//         evented: false,
//       });
//     }

//     var line = makeLine([250, 125, 250, 175]);

//     canvas.add(line);

//     canvas.add(
//       makeCircle(line.get('x1'), line.get('y1'), null, line),
//       makeCircle(line.get('x2'), line.get('y2'), line)
//     );

//     canvas.on('object:moving', function (e) {
//       var p = e.target;
//       p.line1 && p.line1.set({
//         'x2': p.left,
//         'y2': p.top
//       });
//       p.line2 && p.line2.set({
//         'x1': p.left,
//         'y1': p.top
//       });
//       canvas.renderAll();
//     });
//   }
//   console.log(JSON.stringify(canvas));
// })();

var canvasDemo = (function () {
  var _config = {
    canvasState: [],
    currentStateIndex: -1,
    undoStatus: false,
    redoStatus: false,
    undoFinishedStatus: 1,
    redoFinishedStatus: 1,
    undoButton: document.getElementById('undo'),
    redoButton: document.getElementById('redo'),
  };
  canvas.on(
    'object:modified',
    function () {
      updateCanvasState();
    }
  );

  canvas.on(
    'object:added',
    function () {
      updateCanvasState();
    }
  );

  var updateCanvasState = function () {
    if ((_config.undoStatus == false && _config.redoStatus == false)) {
      var jsonData = canvas.toJSON();
      var canvasAsJson = JSON.stringify(jsonData);
      if (_config.currentStateIndex < _config.canvasState.length - 1) {
        var indexToBeInserted = _config.currentStateIndex + 1;
        _config.canvasState[indexToBeInserted] = canvasAsJson;
        var numberOfElementsToRetain = indexToBeInserted + 1;
        _config.canvasState = _config.canvasState.splice(0, numberOfElementsToRetain);
      } else {
        _config.canvasState.push(canvasAsJson);
      }
      _config.currentStateIndex = _config.canvasState.length - 1;
      if ((_config.currentStateIndex == _config.canvasState.length - 1) && _config.currentStateIndex != -1) {
        _config.redoButton.disabled = "disabled";
      }
    }
  }


  var undo = function () {
    if (_config.undoFinishedStatus) {
      if (_config.currentStateIndex == -1) {
        _config.undoStatus = false;
      } else {
        if (_config.canvasState.length >= 1) {
          _config.undoFinishedStatus = 0;
          if (_config.currentStateIndex != 0) {
            _config.undoStatus = true;
            canvas.loadFromJSON(_config.canvasState[_config.currentStateIndex - 1], function () {
              var jsonData = JSON.parse(_config.canvasState[_config.currentStateIndex - 1]);
              canvas.renderAll();
              _config.undoStatus = false;
              _config.currentStateIndex -= 1;
              _config.undoButton.removeAttribute("disabled");
              if (_config.currentStateIndex !== _config.canvasState.length - 1) {
                _config.redoButton.removeAttribute('disabled');
              }
              _config.undoFinishedStatus = 1;
            });
          } else if (_config.currentStateIndex == 0) {
            canvas.clear();
            _config.undoFinishedStatus = 1;
            _config.undoButton.disabled = "disabled";
            _config.redoButton.removeAttribute('disabled');
            _config.currentStateIndex -= 1;
          }
        }
      }
    }
  }

  var redo = function () {
    if (_config.redoFinishedStatus) {
      if ((_config.currentStateIndex == _config.canvasState.length - 1) && _config.currentStateIndex != -1) {
        _config.redoButton.disabled = "disabled";
      } else {
        if (_config.canvasState.length > _config.currentStateIndex && _config.canvasState.length != 0) {
          _config.redoFinishedStatus = 0;
          _config.redoStatus = true;
          canvas.loadFromJSON(_config.canvasState[_config.currentStateIndex + 1], function () {
            var jsonData = JSON.parse(_config.canvasState[_config.currentStateIndex + 1]);
            canvas.renderAll();
            _config.redoStatus = false;
            _config.currentStateIndex += 1;
            if (_config.currentStateIndex != -1) {
              _config.undoButton.removeAttribute('disabled');
            }
            _config.redoFinishedStatus = 1;
            if ((_config.currentStateIndex == _config.canvasState.length - 1) && _config.currentStateIndex != -1) {
              _config.redoButton.disabled = "disabled";
            }
          });
        }
      }
    }
  }


  return {

    undoButton: _config.undoButton,
    redoButton: _config.redoButton,
    undo: undo,
    redo: redo,
  };

})();
canvasDemo.undoButton.addEventListener('click', function () {
  canvasDemo.undo();
});


canvasDemo.redoButton.addEventListener('click', function () {
  canvasDemo.redo();
});
