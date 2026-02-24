<template>
    <div class="space-x-5 mt-8">

        <i @click="$emit('dotClicked')" v-for="(dot, index) in this.amountOfDots" class="fa-solid fa-circle scale-150 cursor-pointer" :class="{ 'text-orange-400' : index === this.selectedDot }">

        </i>

    </div>
</template>

<script>
export default {
    name: "Dots",
    props: ['amountOfDots', 'selectedDot'],
    emits: ['dotClicked']
}
</script>

<style scoped>

</style>
