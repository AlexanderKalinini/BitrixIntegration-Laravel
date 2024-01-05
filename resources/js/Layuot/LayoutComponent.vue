<script>
import Header from "../../Components/Header.vue";

export default {
    components: {
        Header,
    },
};
</script>
<template>
    <Header />
    <slot></slot>
</template>
