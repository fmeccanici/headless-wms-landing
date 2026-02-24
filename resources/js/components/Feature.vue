<template>
    <div class="flex flex-col items-center">
        <div>
            <dt>
                <div class="flex items-center justify-center h-20 w-20 rounded-full text-white bg-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" :d="svg_path_shape" />
                    </svg>
                </div>
                <p class="mt-5 text-lg leading-6 font-medium text-gray-900">{{ title }}</p>
            </dt>
            <dd class="mt-2 text-base text-gray-500">{{ text }}</dd>
        </div>
    </div>
</template>

<script>
export default {
    name: "Feature",
    props: ['title', 'text', 'svg_path_shape']
}
</script>

<style scoped>

</style>
