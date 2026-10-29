<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Céval</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        krem: '#F5F1E7',
                        cokelat: '#8B7D6B',
                        kuning_highlight: '#FFF000'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');
        body { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-krem text-[#2D2D2D]">

    <nav class="flex justify-between items-center px-8 py-4 bg-krem/90 sticky top-0 border-b border-cokelat/30 z-50">
        <div class="font-bold text-xl text-cokelat cursor-pointer">MAISON CÉVAL</div>
        <div class="space-x-4 font-sans text-sm">
            <a href="#" class="px-4 py-2 bg-cokelat text-white rounded hover:bg-opacity-80">Home</a>
            <a href="#category" class="px-4 py-2 bg-cokelat text-white rounded hover:bg-opacity-80">Category</a>
        </div>
    </nav>

    <header class="text-center py-12 px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-cokelat mb-2 tracking-widest">MAISON CÉVAL</h1>
        <p class="text-sm tracking-[0.2em] mb-12 uppercase font-bold text-cokelat">— Pure Taste. Pure Class —</p>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-8 max-w-6xl mx-auto text-left">

            <div class="md:col-span-3 bg-white/70 p-8 md:p-10 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold text-cokelat mb-4">
                    Our Story
                </h2>

                <p class="text-sm md:text-base leading-8 text-gray-700">
                    Maison Céval menghadirkan pilihan rasa dan pengalaman
                    yang mengutamakan kualitas, keindahan, dan perhatian
                    terhadap setiap detail. Kami percaya bahwa setiap
                    sajian memiliki cerita dan setiap momen layak dirayakan
                    dengan sesuatu yang istimewa.
                </p>
            </div>

            <div class="md:col-span-2 bg-cokelat/20 rounded-lg min-h-64 md:min-h-80
                        flex items-center justify-center overflow-hidden">
                <img src=""
                     alt="Maison Céval Product"
                     class="w-full h-full min-h-64 md:min-h-80 object-cover">
            </div>

        </div>
    </header>

    <section id="category" class="px-6 md:px-12 lg:px-20 py-16 md:py-24">

        <div class="mb-10 md:mb-14">
            <p class="font-sans text-xs tracking-[0.3em] uppercase text-cokelat mb-3">
                Discover Our Collection
            </p>

            <h2 class="text-3xl md:text-4xl font-bold text-cokelat">
                Our Catalog
            </h2>

            <div class="w-20 h-1 bg-kuning_highlight mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <a href="#"
               class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">

                <div class="aspect-[4/5] bg-[#E7DDD0] overflow-hidden">
                    <img src=""
                         alt="Catalog 1"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-cokelat mb-2">
                        A
                    </h3>

                    <p class="font-sans text-xs text-gray-600 leading-6">
                        lorem ipsum
                    </p>
                </div>

            </a>

            <a href="#"
               class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">

                <div class="aspect-[4/5] bg-[#E7DDD0] overflow-hidden">
                    <img src=""
                         alt="Catalog 2"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-cokelat mb-2">
                        B
                    </h3>

                    <p class="font-sans text-xs text-gray-600 leading-6">
                        Lorem ipsum
                    </p>
                </div>

            </a>


            <a href="#"
               class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">

                <div class="aspect-[4/5] bg-[#E7DDD0] overflow-hidden">
                    <img src=""
                         alt="Catalog 3"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-cokelat mb-2">
                        C
                    </h3>

                    <p class="font-sans text-xs text-gray-600 leading-6">
                        Lorem Ipsum
                    </p>
                </div>

            </a>


            <a href="#"
               class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">

                <div class="aspect-[4/5] bg-[#E7DDD0] overflow-hidden">
                    <img src=""
                         alt="Catalog 4"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-cokelat mb-2">
                        D
                    </h3>

                    <p class="font-sans text-xs text-gray-600 leading-6">
                        Lorem Ipsum
                    </p>
                </div>

            </a>

        </div>

    </section>


    <footer id="contact" class="bg-cokelat text-white px-6 md:px-12 lg:px-20 py-10 md:py-14">

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row
                    justify-between gap-8">

            <div>
                <h2 class="text-xl font-bold tracking-widest mb-3">
                    MAISON CÉVAL
                </h2>

                <p class="font-sans text-sm text-white/80 leading-7 max-w-sm">
                    Pure Taste. Pure Class.
                    <br>
                    A little elegance in every occasion.
                </p>
            </div>

            <div>
                <h3 class="font-bold mb-4">Explore</h3>

                <div class="flex flex-col gap-3 font-sans text-sm text-white/80">
                    <a href="#home" class="hover:text-kuning_highlight transition">
                        Home
                    </a>

                    <a href="#category" class="hover:text-kuning_highlight transition">
                        Category
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-4">Contact Us</h3>

                <div class="flex flex-col gap-3 font-sans text-sm text-white/80">
                    <a href="mailto:hello@maisonceval.com"
                       class="hover:text-kuning_highlight transition">
                        Email Us
                    </a>

                    <a href="#contact"
                       class="hover:text-kuning_highlight transition">
                        Get in Touch
                    </a>
                </div>
            </div>

        </div>

        <div class="max-w-7xl mx-auto border-t border-white/20 mt-10 pt-5
                    font-sans text-xs text-white/60 text-center md:text-left">
            &copy; 2026 Maison Céval. All rights reserved.
        </div>

    </footer>
    </body>
</html>