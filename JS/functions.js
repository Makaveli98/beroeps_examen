function check_if_admin_page () {
    var header = document.getElementById('header');
    var figure = document.getElementById('figure');


    if(document.URL.includes("index.admin.php") || document.URL.includes("reizen.admin.php") || document.URL.includes("bestemming.admin.php") 
    || document.URL.includes("accommodatie.admin.php") || document.URL.includes("fac.admin.php") || document.URL.includes("r_overview.admin.php") 
    || document.URL.includes("b_overview.admin.php") || document.URL.includes("a_overview.admin.php") || document.URL.includes("f_overview.admin.php")
    || document.URL.includes("boeking.admin.php")) 
    {
        // header
        header.style.width = "85%";
        header.style.marginLeft = "auto";
        header.style.backgroundColor = "unset"; 

        // logo
        figure.style.display = "none";
    }
}

function check_if_boeking_page() {
    var nav = document.getElementById('navbar');
    
    if(document.URL.includes("boeking.php")) 
    {
        // navbar
        nav.style.margin = "unset";
    }
}

check_if_admin_page();
check_if_boeking_page();