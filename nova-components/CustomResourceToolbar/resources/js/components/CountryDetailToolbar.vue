<template>
    <div>
        <div class="flex w-full justify-end items-center">
            <router-link
                title="Go back"
                class="btn btn-default btn-icon  btn-white"
                :to="{ name: 'index', params: { resourceName } }">
                <icon
                    type="arrow-left"
                    style="margin-top: -2px; margin-left: 3px"
                />
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId'],
        computed: {

        }
    }
</script>
