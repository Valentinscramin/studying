<template>

    <Head title="Categorias" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categoria</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Editando: {{ categorie . name }}
                        <Link class="btn btn-warning btn-sm m-10" :href="route('products.index')">Voltar</Link>
                        <div v-if="$page.props.flash.message" class="alert">
                            {{ $page . props . flash . message }}
                        </div>
                        <form @submit.prevent="save()">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" v-model="form.name" id="name" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                                <div v-if="errors.name" class="text-red-500">{{ errors . name }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" v-model="form.active" @click="changeStatus">
                                    <label class="form-check-label"
                                        for="flexSwitchCheckChecked">{{ switchText }}</label>
                                </div>
                                <div v-if="errors.description" class="text-red-500">{{ errors . active }}</div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" :disabled="form.processing"> <span
                                        v-if="form.processing">Atualizando...</span>
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
        ref
    } from 'vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';

    const props = defineProps({
        errors: Object,
        categorie: Object
    });

    const switchText = ref("Desligado");

    const changeStatus = () => {
        switchText.value = form.active ? "Desligado" : "Ligado";
    };

    const form = useForm({
        name: props.categorie.name,
        active: props.categorie.active == 1 ? true : false,
    });

    const save = () => {
        const res = form.put(route('categories.update', props.categorie.id));
        if (res) {
            form.reset();
        }
    }
</script>
