
jQuery(function($){

    var viewer, app;

    function isInCircle(x, y) {
        var relative_x = x - this.x;
        var relative_y = y - this.y;
        return Math.sqrt(relative_x*relative_x + relative_y*relative_y) <= this.r;
    }

    function isInRectangle(x, y) {
        return (this.x1 <= x && x <= this.x2) && (this.y1 <= y && y<= this.y2);
    }

    function getCircleCenter() { return {x: this.x, y: this.y}; }

    function getRectangleCenter() { return {x: (this.x2+this.x1)/2, y: (this.y2+this.y1)/2}; }

    var objects = [
        {x: 100, y: 100, r: 50, isInObject: isInCircle, title: 'big circle', getCenter: getCircleCenter },
        {x: 150, y: 250, r: 35, isInObject: isInCircle, title: 'middle circle', getCenter: getCircleCenter },
        {x: 500, y: 300, r: 10, isInObject: isInCircle, title: 'small circle', getCenter: getCircleCenter },
        {x1: 200, y1: 400, x2: 300, y2: 500, isInObject: isInRectangle, title: 'rectangle', getCenter: getRectangleCenter }
    ]

    function whereIam(x, y) {
        for (var i=0; i<objects.length; i++) {
            var obj = objects[i];
            if (obj.isInObject(x, y))
                return obj;
        }

        return null;
    }

    function showMe(ev, a) {
        $.each(objects, function(i, object) {
            if (object.title == $(a).html()) {
                var center = object.getCenter();
                var offset = viewer.iviewer('imageToContainer', center.x, center.y);
                var containerOffset = viewer.iviewer('getContainerOffset');
                var pointer = $('#pointer');
                offset.x += containerOffset.left - 20;
                offset.y += containerOffset.top - 40;
                pointer.css('display', 'block');
                pointer.css('left', offset.x+'px');
                pointer.css('top', offset.y+'px');
            }
        });

        ev.preventDefault();
    }

    window.showMe = showMe;

    viewer = $("#viewer").iviewer({
        src: "/bundles/app/map.jpg",
        zoom: 125,

        onClick: function(ev, coords) {
            console.log('Mark mountain at ' + coords.x + ", " + coords.y);
            var object = whereIam(coords.x, coords.y);

            if (object)
                alert('Clicked at ('+coords.x+', '+coords.y+'). This is '+object.title);
        },

        onMouseMove: function(ev, coords) {
            var object = whereIam(coords.x, coords.y);

            if (object) {
                $('#status').html('You are in ('+coords.x.toFixed(1)+', '+coords.y.toFixed(1)+'). This is '+object.title);
                this.container.css('cursor', 'crosshair');
            } else {
                $('#status').html('You are in ('+coords.x.toFixed(1)+', '+coords.y.toFixed(1)+'). This is empty space');
                this.container.css('cursor', null);
            }
        },

        onBeforeDrag: function(ev, coords) {
            // remove pointer if image is getting moving
            // because it's not actual anymore
            $('#pointer').css('display', 'none');
            // forbid dragging when cursor is whithin the object
            return whereIam(coords.x, coords.y) ? false : true;
        },

        onZoom: function(ev) {
            // remove pointer if image is resizing
            // because it's not actual anymore
            $('#pointer').css('display', 'none');
        },

        initCallback: function(ev) {
            this.container.context.iviewer = this;
        }
    });
});

function findCentroid(points) {
    var centroid = [0, 0];

    for (var i = 0; i < points.length; i+=2) {
        centroid[0] += points[i];
        centroid[1] += points[i+1];
    }

    var totalPoints = points.length/2;
    centroid[0] = centroid[0] / totalPoints;
    centroid[1] = centroid[1] / totalPoints;

    return centroid;
};

function findMidpoint(x1, y1, x2, y2) {
    return [
        (x1 + x2) / 2,
        (y1 + y2) / 2
    ];
};
function findDistance(x1, y1, x2, y2) {
    return Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
};

function findMinMax(points) {
    var solution = {
        points: 0,
        midpoint: [0, 0],
        area: 0,
        longest: [[0, 0], [0, 0]],
        longestDistance: 0,
        lowest: [0, 0],
        greatest: [0, 0]
    };
    for (var i = 0; i < points.length; i+=4) {
        var x = points[i],
            y = points[i+2],
            x2 = points[i+1],
            y2 = points[i+3]
            ;
        if (solution.points == 0) {
            var midpoint = findMidpoint(x, y, x2, y2);
            var d1 = findDistance(x);
            var centroid = findCentroid(points);

            solution = {
                points: 1,
                midpoint: [centroid[0], centroid[1]],
                longest: [[x, y], [x2, y2]],
                longestDistance: d1,
                area: 0,
                lowest: [, 0],
                greatest: [0, 0]
            };
            continue;
        }
    }
};

var app = {};


var editor = app.editor = new function() {
    this.mode = null;
    this.context = null;
    this.dirty = false;
    this.data = {};

    this.setData = function(data) {
        this.data = data;
    };

    this.reset = function() {
        var ctx = $('canvas')[0].getContext('2d');
        $('.editor-reset').click();
        this.dirty = false;
        this.drawLayers();
    };

    this.finish = function() {
        console.log(this.data);
        console.log(this.mode);
        var data = this.data[this.mode];
        data[data.length] = $('#map-points').val().split(',');
        for (var i = 0; i < data.length; i++) {
            for (var j = 0; j < data[i].length; j++) {
                data[i][j] = parseInt(data[i][j]);

            }
        }

        $('#update-form').append($('<input type="text" name="map_layers[mapLayers][MOUNTAIN][pointSets][][points]" />').val($('#map-points').val()));


        this.reset();
        this.print();
    };

    this.print = function() {
        var str = '';
        console.log(this.data);
        for (var i in this.data) {
            str += (i == 0 ? ': [' : '], ');
            for (var j = 0; j < this.data[i].length; j++) {
                str += (j == 0 ? '' : ', ') + '[';
                for (var k = 0; k < this.data[i][j].length; k++) {
                    str += (k == 0 ? '' : ', ') + this.data[i][j][k];
                }
                str += ']';
            }
        }
        console.log(str);
    };

    this.drawLayers = function() {
        if (!this.context) {
            var ctx = $('canvas')[0].getContext('2d');
            this.context = ctx;
        }
        var context = this.context;
        console.log(this.data);
        for (var mode in this.data) {
            for (var i = 0; i < this.data[mode].length; i++) {

                var centroid = findCentroid(this.data[mode][i]);
                var base_image = new Image();
                base_image.src = 'bundles/app/' + mode.toLowerCase() + '.png';
                context.drawImage(base_image, centroid[0] - 50, centroid[1] - 50, 100, 100);
            }
        }
    };
};