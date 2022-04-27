var searchNode;

window.onload = () => {
    searchNode = $("#search")[0];
}

window.submitSearch = () => {
    event?.preventDefault();

    if(!isEmptyOrSpaces(searchNode.value))
        $.post( "search.php", { search: searchNode.value} );
}

function isEmptyOrSpaces(str){
    return str === null || str.match(/^ *$/) !== null;
}