<?php
$countries = $country->get_all()['error'] === null ? $country->get_all()['data'] : [];
$categories = $category->get_all()['error'] === null ? $category->get_all()['data'] : [];
?>
<section class="relative">
    <div class="pt-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-white">Find Your Dream Course</h1>
    </div>
</section>
<form method="POST" action="courses">
    <section class="py-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-4 lg:px-[10rem] px-4">
            <!-- Search Course -->
            <div class="flex items-center bg-white rounded-lg shadow-md px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 6H3" />
                    <path d="M10 12H3" />
                    <path d="M10 18H3" />
                    <circle cx="17" cy="15" r="3" />
                    <path d="m21 19-1.9-1.9" />
                </svg>
                <input name="search" type="text" placeholder="Search Course"
                    class="ml-2 w-full focus:outline-none"
                    value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
            </div>

            <!-- Select Study Level -->
            <div class="flex items-center bg-white rounded-lg shadow-md px-4 py-3">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M4 4h12v2H4V4zM4 8h12v2H4V8zM4 12h12v2H4v-2z"></path>
                </svg>
                <select name="study_level" class="ml-2 w-full focus:outline-none">
                    <option value="">Select Study Level</option>
                    <option value="Bachelor" <?= ($filters['study_level'] ?? '') === 'Bachelor' ? 'selected' : '' ?>>Bachelor</option>
                    <option value="Master" <?= ($filters['study_level'] ?? '') === 'Master' ? 'selected' : '' ?>>Master</option>
                    <option value="PhD" <?= ($filters['study_level'] ?? '') === 'PhD' ? 'selected' : '' ?>>PhD</option>
                </select>
            </div>

            <!-- Select Destination -->
            <div class="flex items-center bg-white rounded-lg shadow-md px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                <select name="country_id" class="ml-2 w-full focus:outline-none">
                    <option value="">Select Destination</option>
                    <?php foreach ($countries as $row): ?>
                        <option value="<?= $row['id'] ?>" <?= ($filters['country_id'] ?? '') == $row['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['f1']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Select Category -->
            <div class="flex items-center bg-white rounded-lg shadow-md px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                    <path d="m21.854 2.147-10.94 10.939" />
                </svg>
                <select name="subject" class="ml-2 w-full focus:outline-none">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $row): ?>
                        <option value="<?= $row['id'] ?>" <?= ($filters['subject'] ?? '') == $row['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['f1']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Buttons Row -->
        <div class="flex justify-center gap-4 mt-6">
            <!-- Search Button -->
            <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors duration-300 text-sm font-medium whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                Search your course
            </button>
        </div>
    </section>
</form>

