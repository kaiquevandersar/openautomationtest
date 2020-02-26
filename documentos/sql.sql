create table dklClinica.contato(
  id integer auto_increment,
  nome varchar(50),
  email varchar(50),
  assunto varchar(20),
  mensagem varchar(700),
  primary key(id)
);

create table dklClinica.paciente(
  codPaciente integer auto_increment,
  nome varchar(50),
  telefone varchar(20),
  primary key(codPaciente)
);

create table dklClinica.funcionario(
  codFuncionario integer auto_increment,
  nome varchar(50),
  dataNascimento date,
  sexo varchar(1),
  estadoCivil varchar(11),
  cargo varchar(20),
  especialidade varchar(50),
  cpf varchar(11),
  rg varchar(20),
  outro varchar(20),
  cep integer,
  tipoLogradouro varchar(10),
  logradouro varchar(50),
  numero integer,
  complemento varchar(20),
  bairro varchar(40),
  cidade varchar(25),
  estado varchar(2),
  primary key(codFuncionario)
);

create table dklClinica.agenda(
  codAgendamento integer auto_increment,
  data date,
  hora integer,
  codFuncionario integer not null,
  codPaciente integer not null,
  primary key (codAgendamento),
  foreign key (codFuncionario) references dklClinica.funcionario(codFuncionario),
  foreign key (codPaciente) references dklClinica.paciente(codPaciente),
  unique(data, hora, codFuncionario)
);

create table dklClinica.endereco(
  cep integer,
  logradouro varchar(50),
  bairro varchar(40),
  cidade varchar(25),
  primary key (cep)
);

create table dklClinica.usuario(
  login varchar(15),
  senha varchar(15),
  primary key(login)
);

/*
 drop table dklClinica.paciente;
 drop table dklClinica.agenda;
 drop table dklClinica.funcionario;
 
 create table dklClinica.teste(
 id varchar(10),
 hora integer,
 nome varchar(10),
 primary key(id),
 unique(hora,nome)
 );
 
 
 SELECT hora
 FROM dklClinica.agenda;
 
 SELECT hora
 FROM dklClinica.agenda
 WHERE `data` = '2017-11-15' and  codFuncionario =
 (SELECT codFuncionario from dklClinica.funcionario where nome = 'kaique' );
 
 
 SELECT F.nome, F.especialidade , A.hora , A.data, P.nome as nomep , P.telefone
 FROM dklClinica.funcionario F , dklClinica.agenda A, dklClinica.paciente P
 where F.codFuncionario = A.codFuncionario and A.codPaciente = P.codPaciente
 order by F.nome, A.data, A.hora ASC;
 
 create table dklClinica.enderecofunc(
 id integer auto_increment,
 cep varchar(11),
 logradouro varchar(50),
 bairro varchar(40),
 cidade varchar(25),
 estado varchar(2),
 numero integer,
 tipoLogradouro varchar(10),
 complemento varchar(20),
 codFuncionario integer not null,
 primary key (id),
 unique(codFuncionario),
 foreign key (codFuncionario) references dklClinica.funcionario(codFuncionario)
 
 );
 
 */