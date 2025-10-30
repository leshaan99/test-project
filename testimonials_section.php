<?php
$testimonials = $testimonial->get_all()['error'] === null ? $testimonial->get_all()['data'] : null;
?>

<section class="bg-gray-100 py-16">
    <div class="container mx-auto p-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Our Students, Our Pride</h2>
            <p class="text-gray-600 mb-8">Empowering Experiences Shared by Our Learners.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <?php if (empty($testimonials)): ?>
                <p class="text-center text-gray-500 col-span-full">No Testimonial Available.</p>
            <?php else: ?>
                <?php foreach ($testimonials as $key): ?>
                    <div class="relative bg-gray-200 rounded-xl overflow-hidden shadow-lg cursor-pointer group transform transition duration-500 hover:scale-105"
                         onclick="showVideo('<?= htmlspecialchars($key['f2'], ENT_QUOTES) ?>', '<?= htmlspecialchars($key['f1'], ENT_QUOTES) ?>')">
                        <img src="<?= htmlspecialchars($key['img1'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($key['f1'], ENT_QUOTES) ?>" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-30">
                            <svg class="w-14 h-14 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                        <p class="text-center text-base text-gray-500 italic font-semibold mt-3 my-2"><?= htmlspecialchars($key['f1'], ENT_QUOTES) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Universal Video Modal -->
    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl w-full max-w-4xl relative">
            <button class="absolute -top-10 right-0 text-white hover:text-gray-300 text-2xl" onclick="hideVideo()">
                ✖
            </button>
            <div class="aspect-w-16 aspect-h-9 w-full">
                <div id="videoPlayer" class="w-full h-96 rounded-t-xl"></div>
            </div>
            <div class="p-4 text-center">
                <h3 id="videoTitle" class="text-lg font-semibold mb-2"></h3>
                <button onclick="hideVideo()" class="py-2 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Close Video
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    function showVideo(url, title) {
        // Set the title
        document.getElementById('videoTitle').textContent = title || 'Video Player';
        
        // Create the appropriate player based on URL
        const player = document.getElementById('videoPlayer');
        player.innerHTML = ''; // Clear previous content
        
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            // Handle YouTube URLs
            let videoId = '';
            if (url.includes('v=')) {
                videoId = url.split('v=')[1].split('&')[0];
            } else if (url.includes('youtu.be/')) {
                videoId = url.split('youtu.be/')[1].split('?')[0];
            }
            player.innerHTML = `
                <iframe class="w-full h-full" 
                    src="https://www.youtube.com/embed/${videoId}?autoplay=1" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            `;
        } else if (url.includes('vimeo.com')) {
            // Handle Vimeo URLs
            const videoId = url.split('vimeo.com/')[1].split('?')[0];
            player.innerHTML = `
                <iframe class="w-full h-full" 
                    src="https://player.vimeo.com/video/${videoId}?autoplay=1" 
                    frameborder="0" 
                    allow="autoplay; fullscreen" 
                    allowfullscreen>
                </iframe>
            `;
        } else if (url.match(/\.(mp4|webm|ogg|mov|avi|wmv)$/i)) {
            // Handle direct video files
            player.innerHTML = `
                <video controls autoplay class="w-full h-full">
                    <source src="${url}" type="video/${url.split('.').pop().toLowerCase()}">
                    Your browser doesn't support HTML5 video.
                </video>
            `;
        } else {
            // Generic iframe fallback
            player.innerHTML = `
                <iframe class="w-full h-full" 
                    src="${url}" 
                    frameborder="0" 
                    allowfullscreen>
                </iframe>
            `;
        }
        
        // Show the modal
        document.getElementById('videoModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideVideo() {
        // Clear the player and hide modal
        document.getElementById('videoPlayer').innerHTML = '';
        document.getElementById('videoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideVideo();
        }
    });
</script>