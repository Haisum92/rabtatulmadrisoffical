var dt = new Date(),
    dt2 = new Date();
dt2.setDate(dt.getDate() + 1);
var arr = [{
    stDt: dt,
    c: 'a'
}, {
    stDt: dt,
    c: 'a1'
}, {
    stDt: dt2,
    c: 'b'
}, {
    stDt: dt2,
    c: 'b1'
}];

var strFinal = "<tr>";
var prevDate = null;

var dateCourseTd = function (obj) {
    var str = "";
    str = str + "<td>";
    str = str + obj.stDt.getDate();
    str = str + "</td>";
    str = str + "<td>";
    str = str + obj.c;
    str = str + "</td>";
    return str;
}

$(arr).each(function (index, obj) {
    if (obj.stDt == prevDate) {
        strFinal = strFinal + dateCourseTd(obj);
    } else {
        strFinal = strFinal + "</tr><tr>";
        strFinal = strFinal + dateCourseTd(obj);
    }
    prevDate=obj.stDt;
});

$('#myDiv').html(strFinal);

========================




var dt = new Date(),
    dt2 = new Date(),
    dt3 = new Date();
dt2.setDate(dt.getDate() + 1);
dt3.setDate(dt.getDate() + 2);
var arr = [{
    stDt: dt,
    c: 'a'
}, {
    stDt: dt,
    c: 'a1'
}, {
    stDt: dt2,
    c: 'b'
}, {
    stDt: dt2,
    c: 'b1'
}, {
    stDt: dt3,
    c: 'c'
}];

var strFinal = "<tr>";
var prevDate = null;
var i = 0;

var dateCourseTd = function (obj) {
    var str = "";
    str = str + "<td>";
    str = str + obj.stDt.getDate();
    str = str + "</td>";
    str = str + "<td>";
    str = str + obj.c;
    str = str + "</td>";
    return str;
}

$(arr).each(function (index, obj) {
    if (obj.stDt == prevDate) {
        i++;
        strFinal = strFinal + dateCourseTd(obj);
    } else {
        if (i == 0) {
            strFinal = strFinal + "<td></td><td></td>";
        }

        strFinal = strFinal + "</tr><tr>";
        strFinal = strFinal + dateCourseTd(obj);
        i = 0;
    }
    prevDate = obj.stDt;
});
if (i == 0) {
    strFinal = strFinal + "<td></td><td></td>";
}

strFinal = strFinal + "</tr>";

$('#myDiv').html(strFinal);