<?php
get_header();
?>
<main class="w-full min-h-screen flex items-center justify-center bg-[#EEEEEE] text-[#111111] font-mono text-3xl font-light overflow ">
    <div class="flex flex-col items-center justify-center gap-1">
        <div class="flex items-end gap-4">
            <span class="text-1">Lorem Ipsum Dolor Sit Amet</span>
            <img id="explode-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/house.jpg" class="inline-block w-[96px] h-[64px] object-cover" />
            <span class="text-2">Consectetur. Etiam Tincidunt</span>
        </div>
        <p class="some-text text-center w-[1060px]">This is a simple text to showcase the animation This is a simple text to showcase the animation</p>
    </div>
</main>
<?php
get_footer();
