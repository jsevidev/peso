function viewApplicant(appl_profile_id) {
    // show modal
    document.getElementById("viewModal").style.display = "flex";

    // load content
    fetch("backend/fetch_appl_details.php?id=" + appl_profile_id)
        .then(response => response.text())
        .then(data => {
            document.getElementById("viewModalContent").innerHTML = data;
        });
}

function closeViewModal() {
    document.getElementById("viewModal").style.display = "none";
}
