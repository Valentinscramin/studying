<template>

    <Head title="Produtos" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produtos</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Novo Produto
                        <Link class="btn btn-warning btn-sm m-10" :href="route('products.index')">Voltar</Link>
                        <form @submit.prevent="save()">
                            <div class="mb-3">
                                <img :src="form.imgPreview || 'https://cdn.pixabay.com/photo/2014/06/03/19/38/test-361512_640.jpg'"
                                    alt="" height="300px" width="200">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="image" @change="handleFileUpload">
                                <div v-if="errors.img" class="text-red-500">{{ errors . img }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" v-model="form.name" id="name" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.name" class="text-red-500">{{ errors . name }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" v-model="form.description" id="description" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.description" class="text-red-500">{{ errors . description }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <input type="text" v-model="form.price" id="price" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.price" class="text-red-500">{{ errors . price }}</div>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" v-model="form.category">
                                    <option selected disabled>Categoria</option>
                                    <option v-for="(item, index) in categories" :key="index"
                                        :value="item.id">
                                        {{ item . name }}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" :disabled="form.processing"> <span
                                        v-if="form.processing">Criando...</span>
                                    <span v-else>Salvar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';

    defineProps({
        errors: Object,
        categories: Array
    });

    const handleFileUpload = (event) => {
        const file = event.target.files[0];
        form.img = file;
        if (file) {
            form.imgPreview = URL.createObjectURL(file);
        }
    };

    const form = useForm({
        name: '',
        description: '',
        category: '',
        price: '',
        img: '',
        imgPreview: ''
    });

    const save = () => {
        const res = form.post(route('products.store'), {
            forceFormData: true,
            data: form,
            onSuccess: () => {
                form.reset();
            },
            onError: (errors) => {
                console.error(error);
            }
        });
    }
</script>
