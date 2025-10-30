<?php
include 'header.php';
include 'nav.php';

if (isset($_GET['event_id'])) {
    $encoded_event_id = $_GET['event_id'];
    $event_id = base64_decode($encoded_event_id);
    $event_data = $event->getEventById($event_id);

    if ($event_data) {
        $event_details = $event_data['data'];
?>
        <div class="mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 text-center mt-4">
                <?= isset($event_details['f1']) ? htmlspecialchars($event_details['f1']) : 'Title Not Available' ?>
            </h1>
            <p class="text-gray-600 text-center">
                <?= isset($event_details['f2']) ? htmlspecialchars($event_details['f2']) : 'Subtitle Not Available' ?>
            </p>

            <div class="grid md:grid-cols-2 mt-5">
                <div class="flex justify-center my-4">
                    <?php
                    $img = isset($event_details['img1']) && !empty($event_details['img1'])
                        ? $event_details['img1']
                        : './assets/images/NA Image.jpg';
                    ?>
                    <img src="<?= $img ?>" alt="Not Available" class="rounded-lg shadow-md w-full md:w-3/4">
                </div>

                <div>
                    <p class="mt-2 text-gray-600">
                        <?= !empty($event_details['f3']) ? convertHtmlToTailwind($event_details['f3']) : 'Content Not Available'; ?>
                    </p>
                </div>
            </div>
            <div class="md:col-span-12 rounded-lg flex justify-end pr-4 mt-0">
                <button onclick="shareEvent('<?= $event_id ?>')"
                    class="p-3 bg-gray-200 rounded-full hover:bg-gray-300 transition duration-200 shadow-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-share">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M8.7 10.7l6.6 -3.4" />
                        <path d="M8.7 13.3l6.6 3.4" />
                    </svg>
                </button>
            </div>
        </div>
<?php
    } else {
        echo "<p class='text-red-500 text-center'>Event not found.</p>";
    }
} else {
    echo "<p class='text-red-500 text-center'>Invalid request.</p>";
}

include 'footer.php';
?>
</body>

</html>

<script>
    function shareEvent(eventId) {
        const eventURL = `${window.location.href}?event_id=${eventId}`;

        if (navigator.share) {
            navigator.share({
                    text: "Check out this event!",
                    url: eventURL,
                })
                .then(() => console.log('event shared successfully!'))
                .catch((error) => console.error('Error sharing:', error));
        } else {
            navigator.clipboard.writeText(eventURL).then(() => {
                alert("event link copied to clipboard!");
            }).catch(() => {
                alert("Failed to copy link.");
            });
        }
    }
</script>