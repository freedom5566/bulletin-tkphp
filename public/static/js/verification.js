function validateForm() {

    if (document.getElementById("title").value === "") {
        alert("請輸入標題");
        return false;
    }
    else if (trimfield(document.getElementById("message").value) === "") {
        alert("請輸入內文");
        return false;
    }


};
function trimfield(str) {
    //避免textarea空白問題
    return str.replace(/^\s+|\s+$/g, '');
};