<template>
    <div class="m-2">
        <p class="border border-orange-400 rounded-md p-1">{{ this.content }}</p>
    </div>

</template>

<script>
export default {
    name: "HttpRequest",
    props: ['content']
}
</script>

<style scoped>

</style>
