<template>
    <div class="category-border">{{title}}</div>
</template>

<script>
    export default {
        props: {
            title: {type: String, required: true}
        }
    }
</script>
<style>
    .category-border{
        width: 240px;
        border-bottom: 3px solid #ec2121;
        font-size: 22px;
        color: #525252;
        font-weight: 300;
        text-align: left;
    }
</style>