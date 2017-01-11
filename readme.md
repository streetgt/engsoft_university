# Projeto - Engenharia de software

* Ficheiro das Rotas disponivel em :
    - ficheiro - routes.md;
    - https://www.getpostman.com/collections/39dcdec5679be473f897 (mais detalhado);

1. **Desenvolver um WS1 (Web Service) que permita aos estudantes:** 
	1. inscreverem-se em cursos, atualizar os seus dados.
		* ✔️
	2. inscreverem-se em unidades curriculares.
	    * ✔ (Inscrever-se em turmas)
	3. obterem o seu horário.
	    * ✔
	4. verificar a ocupação das salas.
	    * ✔ - Faz o inverso, ve o horario de ocupação da sala.️
	5. pesquisar se o docente se encontra disponível num determinado dia e período de tempo.
	    * ✔ - Faz o inverso, ve o horario do docente
	6. consultar as suas notas.
	    * ✔    
	7. Adicional.
	    1. Inscrever-se em um Curso.

2. **Desenvolver um WS2 (Web Service) que permita aos docentes:** 
	1. consultarem o seu horário.
	    * ✔
	2. obter a lista de presença por unidade curricular num determinado horário.
	    * X - Presenças não implementado
	3. lançar notas numa unidade curricular.
	    * ✔
	4. pesquisar salas livres.
	    * ✔ - Retorna todas as salas livres baseado na hora atual.
	5. atualizar os seus dados.
	    * ✔

3. **Desenvolver um WS3 (Web Service) que permita aos administrativos:** 
	1. validar as matrículas feitas pelos alunos.
	    * X
	2. criar/inserir unidades curriculares.
	    * ✔
	3. associar docentes a unidades curriculares.
	    * ✔
	4. obter as listas de alunos inscritos.
	    * ✔
	5. criar o horário para as unidades curriculares.
	    * ✔
	6. definir salas para as unidades curriculares.
	    * ✔
	7. consultar a listas das notas de um determinado aluno.
	    * ✔
	8. obter a lista de todas as salas livres num determinado período de tempo.
	    * X - whereNot
	9. Adicional.
    	    1.Criar, remove, atualizar.
    	        1. Salas;
    	        2. Estudantes;
    	        3. Cursos;
    	        4. Disciplinas;

# engsoft_university
