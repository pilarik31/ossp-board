document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchbar");
    const entries = document.querySelectorAll(".entry");

    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.toLowerCase();

        entries.forEach(entry => {
            const name = entry.getAttribute("data-name").toLowerCase();
            if (name.includes(searchValue)) {
                entry.style.display = "block";
            } else {
                entry.style.display = "none";
            }
        });
    });
});

const livePreviewModal = document.getElementById('livePreviewModal');
if (livePreviewModal) {
    livePreviewModal.addEventListener('show.bs.modal', event => {
        const entry = event.relatedTarget.getAttribute('data-bs-entryId');
        const getInputValue = name => document.querySelector(`input[name="leaderboard[${entry}][${name}]"]`).value;
        const getFileInput = name => document.querySelector(`input[name="leaderboard[${entry}][${name}]"]`).files[0];

        const previewTitle = getInputValue('header');
        const previewSubtitle = getInputValue('subtitle');
        const previewName = getInputValue('name');
        const previewClassroom = getInputValue('classroom');

        let previewProfile = getInputValue('profile');
        let previewBgImg = getInputValue('bgImg');

        const profileFile = getFileInput('profileFile');
        const bgImgFile = getFileInput('bgImgFile');

        // Reset to default images
        document.getElementById('preview-profile').src = 'https://www.ossp.cz/wp-content/uploads/2019/10/ossp_logo_nove_white.png';
        document.getElementById('preview-bgImg').src = 'https://www.ossp.cz/wp-content/uploads/2017/11/web_uvodni_foto.jpg';

        if (!previewProfile && profileFile) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-profile').src = e.target.result;
            };
            reader.readAsDataURL(profileFile);
        } else if (previewProfile) {
            document.getElementById('preview-profile').src = previewProfile;
        }

        if (!previewBgImg && bgImgFile) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-bgImg').src = e.target.result;
            };
            reader.readAsDataURL(bgImgFile);
        } else if (previewBgImg) {
            document.getElementById('preview-bgImg').src = previewBgImg;
        }

        document.getElementById('preview-title').textContent = previewTitle;
        document.getElementById('preview-subtitle').textContent = previewSubtitle;
        document.getElementById('preview-name').textContent = previewName;
        document.getElementById('preview-classroom').textContent = previewClassroom;
    });
}