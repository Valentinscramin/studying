<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import Pagination from '@/Components/Pagination.vue';

    defineProps({
        categories: [Object, Array],
    });

    const form = useForm({});

    const deleteCategorie = (categorieId) => {
        if (confirm('Você tem certeza que deseja excluir esse registro?')) {
            form.delete(route('categories.destroy', categorieId));
        }
    }
</script>

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
                        Lista de Categorias
                        <Link class="btn btn-primary btn-sm m-10" :href="route('categories.create')">Novo</Link>
                        <div v-if="$page.props.flash.message" class="alert alert-success">
                            {{ $page . props . flash . message }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Ativo</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="(item, index) in categories.data" :key="index">
                                        <td scope="row">{{ item . name }}</td>
                                        <td>{{ item . active ? 'Ligado' : 'Desligado' }}</td>
                                        <td>
                                            <Link class="btn btn-warning btn-sm"
                                                :href="route('categories.edit', item.id)">Editar
                                            </Link>
                                            <button type="submit" class="btn btn-danger btn-sm ml-2"
                                                @click="deleteCategorie(item.id)">Excluir
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :pagination="categories.links"></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
