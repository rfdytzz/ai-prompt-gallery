<script setup>
import { useRoute, useRouter } from 'vue-router';
import Nav from '@/components/Nav.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const tagData = ref([])

const getDataTag = async () => {
    try {
        const res = await axios.get('http://localhost:8000/api/myprompt/data/tag')
        tagData.value = res.data.tag
    } catch (error) {
        console.log(error)
    }
}

const categoryData = ref([])

const getDataCategory = async () => {
    try {
        const res = await axios.get('http://localhost:8000/api/myprompt/data/category')
        categoryData.value = res.data.category
    } catch (error) {
        console.log(error)
    }
}

const preview = ref(null)
const image = ref(null)
const handleFile = (e) => {
    const file = e.target.files[0]
    preview.value = URL.createObjectURL(file)
    image.value = file
}

const route = useRoute()
const router = useRouter()

const title = ref('')
const description = ref('')
const prompt = ref('')
const tag_id = ref('')
const category_id = ref('')
const thumbnailValue = ref(null)
const data = ref('')
const id = route.params.id
const token = localStorage.getItem('token')
const getData = async () => {
    try {
        const res = await axios.get(`http://localhost:8000/api/myprompt/edit/${id}`,
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        title.value = res.data.data.title
        description.value = res.data.data.description
        prompt.value = res.data.data.prompt
        thumbnailValue.value = res.data.data.thumbnail
        tag_id.value = res.data.data.tag_id
        category_id.value = res.data.data.category_id
    } catch (error) {
        console.log(error)
    }
}

const updatePrompt = async () => {
    try {
        const res = await axios.post(`http://localhost:8000/api/myprompt/edit/${id}`,
            {
                title: title.value,
                description: description.value,
                category_id: category_id.value,
                tag_id: tag_id.value,
                prompt: prompt.value
            },
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        router.push('/profile/myprompt')
        console.log(res.data.message)
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getData()
    getDataCategory()
    getDataTag()
})

</script>

<template>
    <Nav />
    <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full hidden md:block md:fixed md:w-80 h-fit md:h-fit shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/profile/myprompt" :class="route.path === '/profile/myprompt/' ? 'bg-gray-100' : ''" class="bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-command' ></i> My Prompt</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                    <router-link to="/change-password" :class="route.path === '/change-password' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-lock-alt' ></i> Change Password</router-link>
                </ul>
            </div>
            <div class="w-full md:ml-85 md:w-full h-fit pb-10 md:h-fit shadow rounded-xl p-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col">
                        <h2 class="font-bold text-[30px]">Edit Prompt</h2>
                        <p>Edit Prompt</p>
                    </div>
                    <form @submit.prevent="updatePrompt" action="" class="flex flex-col gap-3">
                        <label for="" class="text-sm">Prompt Image <span class="text-orange-500">*</span></label>
                        <label  for="image" class="flex p-5 rounded-xl shadow justify-center text-center flex-col gap-5">
                                <div class="flex flex-col items-center py-10 gap-3">
                                    <img v-if="preview" :src="preview" alt="" class="h-40 w-auto rounded-xl">
                                    <img v-else :src="`http://localhost:8000/storage/${thumbnailValue}`" alt="" class="h-40 w-auto rounded-xl">
                                    <i :class="preview === null ? 'block' : 'hidden'" class='bx bx-upload text-3xl'></i>
                                    <div class="shadow p-3 hover:bg-gray-50 cursor-pointer rounded-xl w-fit">Upload Image</div>
                                    <div class="flex flex-col items-center">
                                        <p class="italic text-sm text-gray-600 font-semibold">or Drag & Drop Image</p>
                                    </div>
                                    <p class="italic text-[11px] text-gray-600 font-semibold">Max: 5Mb, JPG, PNG, JPEG, WEBP</p>
                                </div>
                                <input ref="fileInput" @change="handleFile" type="file" hidden name="" id="image">
                        </label>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Title Prompt <span class="text-orange-500">*</span></label>
                            <input v-model="title" required placeholder="Title" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Description <span class="text-orange-500">*</span></label>
                            <input v-model="description" required placeholder="Description" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Category <span class="text-orange-500">*</span></label>
                            <select v-model="category_id" required placeholder="Description" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                                <option selected value="" disabled>Select Category</option>
                                <option v-for="item in categoryData" :key="item.id" :value="item.id">{{ item.category }}</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Tag <span class="text-orange-500">*</span></label>
                            <select v-model="tag_id" required placeholder="Description" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                                <option selected value="" disabled>Select Tag</option>
                                <option v-for="item in tagData" :key="item.id" :value="item.id">{{ item.tag }}</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Prompt <span class="text-orange-500">*</span></label>
                            <textarea v-model="prompt" required placeholder="Prompt" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id=""></textarea>
                        </div>
                        <button class="w-fit bg-blue-500 cursor-pointer transition duration-200 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-blue-100 flex flex-col gap-4 mt-5 md:mt-5">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>
