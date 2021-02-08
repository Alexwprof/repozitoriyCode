<script>
    let map_container = document.getElementById('map_container');
	let map_container_footer = document.querySelector('.partners');
    let options_map = {
        once: true,//once start, thereafter destroy listener
        passive: true,
        capture: true
    };
    map_container.addEventListener('click', start_lazy_map, options_map);
    map_container.addEventListener('mouseover', start_lazy_map, options_map);
    map_container.addEventListener('touchstart', start_lazy_map, options_map);
    map_container.addEventListener('touchmove', start_lazy_map, options_map);
	map_container_footer.addEventListener('touchmove', start_lazy_map, options_map);
	map_container_footer.addEventListener('mouseover', start_lazy_map, options_map);
	map_container_footer.addEventListener('click', start_lazy_map, options_map);
	

    let map_loaded = false;
    function start_lazy_map() {
        if (!map_loaded) {
            let map_block = document.getElementById('ymap_lazy');
            map_loaded = true;
            map_block.setAttribute('src', map_block.getAttribute('data-src'));
            map_block.removeAttribute('data_src');
            console.log('YMAP LOADED');
        }
    }
</script>

<div id="map_container" class="map container-fluid" style="margin: 0px; padding: 0px; height: 100%;">
<script type="text/javascript" charset="utf-8" id="ymap_lazy" data-skip-moving="true" async=""
 data-src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A871fc5417a994c0df7dbcfbd84e7bc175305c100d923602863fe2c70ed6f660b&amp;width=100%25&amp;height=100%25&amp;lang=ru_RU&amp;scroll=true">
 </script>
</div>
--
