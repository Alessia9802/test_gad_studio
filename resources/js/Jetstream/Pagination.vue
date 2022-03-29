<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap">
            <template v-for="(link, key) in links">
                <div
                    v-if="link.url === null"
                    :key="key"
                    class="mb-1 mr-1 px-4 py-3 bg-white border-gray-300 text-gray-500 hover:bg-gray-50 text-sm leading-4 border rounded"
                    v-html="link.label"
                />
                <Link
                    v-else
                    :key="`link-${key}`"
                    class="bg-white mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:text-indigo-600 hover:bg-indigo-50 border hover:border-indigo-500 focus:border-indigo-500 rounded"
                    :class="{
                        ' bg-indigo-50 border-indigo-500 text-indigo-600':
                            link.active,
                    }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    },
};
</script>
