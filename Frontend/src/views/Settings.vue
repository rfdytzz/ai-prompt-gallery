<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
onMounted(() => {
    document.title = 'Settings | DwayPrompts'
})

const route = useRoute()
const imageUrl = ref(null)
const previewPicture = (event) => {
    const file = event.target.files[0]
    if (file) {
        imageUrl.value = URL.createObjectURL(file)
    }
}

</script>

<template>
    <Nav />
    <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full md:fixed md:w-80 h-fit md:h-50 shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                </ul>
            </div>
        </div>
    </div>
    
</template>